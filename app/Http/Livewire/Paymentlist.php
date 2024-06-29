<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Stock;
use App\Models\Sale;
use App\Models\Client;
class Paymentlist extends Component
{
public $classes=[],$title="Payment",$flag=0;
public $client_id,$ttype=1,$balance,$amount,$date,$description;
public function delete($paymentid)
{
Payment::find($paymentid)->delete();
}
public function addpayment()
{
$this->validate([
"description"=>"required",
]);
if($this->ttype==1)
{
Payment::create([
"client_id"=>$this->client_id,
"credit"=>$this->amount,
"description"=>$this->description,
"created_at"=>$this->date,
"updated_at"=>$this->date,
]);
}
else
{
Payment::create([
"client_id"=>$this->client_id,
"debit"=>$this->amount,
"description"=>$this->description,
"created_at"=>$this->date,
"updated_at"=>$this->date,
]);
}
$this->dispatchBrowserEvent("closemodal");
$this->client_id="";
$this->amount="";
$this->ttype=1;
$this->balance="";
$this->description="";
}
public function updatedClientId()
{
$client=Client::find($this->client_id);
$this->balance=$client->payments->sum("debit")-$client->payments->sum("credit");
}
public function mount()
{
$this->classes[]="bg-primary";
$this->classes[]="bg-danger";
$this->classes[]="bg-dark";
$this->classes[]="bg-info";
$this->classes[]="bg-warning";
$this->classes[]="bg-success";
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
$clients=Client::where("id",">",5)->orderBy("name")->get();
$ids=Stock::pluck("payment_id")->toArray();
$ids=array_merge($ids,Sale::pluck("payment_id")->toArray());
$payments=Payment::whereNotIn("id",$ids)->where("client_id","!=",2)->latest()->with("client")->get();
return view('livewire.paymentlist',compact("payments","clients"))->extends("layouts.wrapper");
}
}