<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Client;
use App\Models\Product;
use App\Models\Stock;
use App\Models\Payment;
class Stockentry extends Component
{
public $orderdata,$total,$date,$vno,$vendorid;
public function addstock()
{
$msg=[
"orderdata.*.productid.required"=>"Select Product First",
];
$this->validate([
"date"=>"required",
"vendorid"=>"required",
"vno"=>"required",
"orderdata.*.productid"=>"required",
],$msg);
$stock=Stock::create([
"client_id"=>$this->vendorid,
"vno"=>$this->vno,
"created_at"=>$this->date,
"updated_at"=>$this->date,
]);
foreach($this->orderdata as $index=>$data)
{
$stock->products()->attach($data['productid'],[
"quantity"=>$data['qty'],
"amount"=>$data['amount'],
]);
}
$payment=Payment::create([
"client_id"=>$this->vendorid,
"stock_id"=>$stock->id,
"description"=>"stock recieved from ".$stock->client->name,
"debit"=>$this->total,
"created_at"=>$this->date,
"updated_at"=>$this->date,
]);
$stock->update(["payment_id"=>$payment->id]);
$this->date="";
$this->total="";
$this->vno="";
$this->vendorid="";
$this->orderdata=[];
$this->plus();
}
public function removeitem($index)
{
unset($this->orderdata[$index]);
$this->orderdata=array_values($this->orderdata);
$this->total=$arrSum = array_sum(array_column($this->orderdata, 'amount'));
}
public function updatedOrderdata($value,$key)
{
$this->resetErrorBag('orderdata.*.productid');
$parts=explode(".",$key);
$index=$parts[0];
$field=$parts[1];
if($this->orderdata[$index]['productid'])
{
if($field=="productid")
{
$pid=$value;
$price=Product::find($pid)->purchase;
$qty=$this->orderdata[$index]['qty'];
$this->orderdata[$index]['amount']=$qty*$price;
}
if($field=="qty")
{
$qty=$value;
$pid=$this->orderdata[$index]['productid'];
$price=Product::find($pid)->purchase;
$this->orderdata[$index]['amount']=$qty*$price;
}
$this->total=$arrSum = array_sum(array_column($this->orderdata, 'amount'));
}
}
public function plus()
{
$this->orderdata[]=[
"productid"=>"",
"qty"=>1,
"amount"=>0,
];
}
public function additem()
{
$this->plus();
}
public function mount()
{
$this->plus();
}
public function render()
{
$vendors=Client::where("ctype",1)->where("id",">",5)->orderBy("name")->get();
$products=Product::orderBy("name")->get();
return view('livewire.stockentry',compact("vendors","products"))->extends("layouts.wrapper");
}
}