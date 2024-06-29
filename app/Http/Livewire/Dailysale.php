<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Product;
use App\Models\Client;
use App\Models\Sale;
use App\Models\Payment;
class Dailysale extends Component
{
public $productid,$qty=1,$total=0,$clientid=1,$barcode,$productname;
public $orderdata=[],$cash=0;
public function changeqty($id,$value)
{
$pid=$this->orderdata[$id]['productid'];
$product=Product::find($pid);
$nqty=$value;
$price=$product->sale;
$name=$product->name;
$amount=$nqty*$price;
$this->orderdata[$id]=[
"productid"=>$pid,
"productname"=>$name,
"qty"=>$nqty,
"price"=>$price,
"amount"=>$amount,
];
$this->total=$arrSum = array_sum(array_column($this->orderdata, 'amount'));
$this->cash=$this->total;
}
public function updatedBarcode()
{
$product=Product::where("barcode",$this->barcode)->first();
$this->productid=$product->id;
if($this->check())
$this->add();
}
public function deal()
{
$sale=Sale::create([
"client_id"=>$this->clientid,
]);
foreach($this->orderdata as $index=>$data)
{
$purchase=Product::find($data['productid'])->purchase;
$sale->products()->attach($data['productid'],[
"quantity"=>$data['qty'],
"amount"=>$data['amount'],
"purchase"=>$purchase*$data['qty'],
]);
}
$payment=Payment::create([
"client_id"=>$this->clientid,
"sale_id"=>$sale->id,
"description"=>"Sale to ".$sale->client->name,
"credit"=>$this->total,
"debit"=>$this->cash,
]);
$sale->update(["payment_id"=>$payment->id]);
return redirect("/print/".$sale->id);
}
public function delete($index)
{
unset($this->orderdata[$index]);
$this->orderdata=array_values($this->orderdata);
$this->total=$arrSum = array_sum(array_column($this->orderdata, 'amount'));
}
public function updatedProductname($pname)
{
$query=Product::where("name",$pname)->first();
if($query)
{
$this->productid=$query->id;
$this->barcode=$product=Product::find($this->productid)->barcode;
$this->check();
} else return;
}
public function check()
{
$this->validate([
"productid"=>"required"
]);
$product=Product::find($this->productid);
$inhand=$product->stocks->sum("pivot.quantity")-$product->sales->sum("pivot.quantity");
if($inhand<=0)
{
$this->addError("productid","Out of Stock");
return false;
}
else return true;
}
public function add()
{
$product=Product::find($this->productid);
$a=array_search($product->id, array_column($this->orderdata, 'productid')) ;
if(!is_numeric($a))
{
$price=$product->sale;
$name=$product->name;
$amount=$this->qty*$price;
$this->orderdata[]=[
"productid"=>$this->productid,
"productname"=>$name,
"qty"=>$this->qty,
"price"=>$price,
"amount"=>$amount,
];
}
else {
$nqty=$this->orderdata[$a]['qty']+$this->qty;
$price=$product->sale;
$name=$product->name;
$amount=$nqty*$price;
$this->orderdata[$a]=[
"productid"=>$this->productid,
"productname"=>$name,
"qty"=>$nqty,
"price"=>$price,
"amount"=>$amount,
];
}
$this->total=$arrSum = array_sum(array_column($this->orderdata, 'amount'));
$this->cash=$this->total;
}
public function render()
{
$products=Product::orderBy("name")->get();
$clients=Client::where("ctype",0)->orderBy("name")->get();
return view('livewire.dailysale',compact("products","clients"))->extends("layouts.wrapper");
}
}