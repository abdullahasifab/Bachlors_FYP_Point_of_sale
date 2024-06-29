<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Client;
use App\Models\Stock;
use Carbon\Carbon;
class Vendorledger extends Component
{
public $classes=[],$title="",$client_id,$payments=[];
public $sdate,$edate;
public $dsdate,$dedate,$stockdata;
public function showdetail($id)
{
$this->stockdata=Stock::find($id);
$this->search();
$this->dispatchBrowserEvent("openmodal");
}
public function search()
{
if($this->client_id)
{
$this->dsdate=$this->sdate;
$this->dedate=$this->edate;
$this->sdate=Carbon::parse($this->sdate)->startOfDay();
$this->edate=Carbon::parse($this->edate)->endOfDay();
$tpayments=Client::find($this->client_id)->payments->whereBetween("created_at",[$this->sdate,$this->edate])->sortBy("created_at");
$b=0;
$collection=collect();
foreach($tpayments as $payment)
{
$detail="";
if($payment->stock) $detail=$payment->stock->detail;
$b+=$payment->debit-$payment->credit;
$collection->push([
"date"=>$payment->date,
"debit"=>$payment->debit,
"credit"=>$payment->credit,
"balance"=>$b,
"detail"=>$detail,
]);
}
$this->payments=json_decode($collection);
$this->sdate=$this->dsdate;
$this->edate=$this->dedate;
}
}
public function mount()
{
$this->classes[]="bg-primary";
$this->classes[]="bg-danger";
$this->classes[]="bg-dark";
$this->classes[]="bg-info";
$this->classes[]="bg-warning";
$this->classes[]="bg-success";
$this->sdate=now()->format("Y-m-d");
$this->edate=now()->format("Y-m-d");
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
$clients=Client::where("ctype",1)->where("id",">",5)->orderBy("name")->get();
return view('livewire.vendorledger',compact("clients"))->extends("layouts.wrapper");
}
}