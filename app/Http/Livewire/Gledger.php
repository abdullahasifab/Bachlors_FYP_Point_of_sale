<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Payment;
use Carbon\Carbon;
class Gledger extends Component
{
public $classes=[];
public $sdate,$edate;
public $dsdate,$dedate;
public $payments=[];
public function search()
{
$this->totalcredit=0;
$this->totalsale=0;
$this->cashinhand=0;
$this->dsdate=$this->sdate;
$this->dedate=$this->edate;
$this->sdate=Carbon::parse($this->sdate)->startOfDay();
$this->edate=Carbon::parse($this->edate)->endOfDay();
$data=Payment::whereBetween("created_at",[$this->sdate,$this->edate])->orderBy("created_at")->get();
$collection=collect();
foreach($data as $item)
{
$r=0;
$p=0;
$c=0;
$b=0;
if($item->stock_id) { $r=$item->debit;}
else
if($item->sale_id) {$r=$item->debit; $c=abs($item->debit-$item->credit);}
else
if($item->client_id==2)  $p=$item->credit;
else
if($item->credit) $p=$item->credit;
else
$r=$item->debit;
$b=$r-$p+$c;
$collection->push([
"date"=>$item->date,
"description"=>$item->description,
"recieved"=>$r,
"payment"=>$p,
"credit"=>$c,
"balance"=>$b,
]) ;
$this->payments=json_decode($collection) ;
}
$this->sdate=$this->dsdate;
$this->edate=$this->dedate;
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
return view('livewire.gledger')->extends("layouts.wrapper");
}
}