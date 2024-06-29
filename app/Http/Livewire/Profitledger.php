<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Sale;
use App\Models\Payment;
use Carbon\Carbon;
class Profitledger extends Component
{
public $classes=[];
public $sdate,$edate;
public $dsdate,$dedate;
public $totalsale,$cost,$grossprofit,$totalexpense,$netprofit;
public function search()
{
$this->totalsale=0;
$this->cost=0;
$this->dsdate=$this->sdate;
$this->dedate=$this->edate;
$this->sdate=Carbon::parse($this->sdate)->startOfDay();
$this->edate=Carbon::parse($this->edate)->endOfDay();
$sales=Sale::whereBetween("created_at",[$this->sdate,$this->edate])->orderBy("created_at")->get();
foreach($sales as $sale)
{
$this->cost+=$sale->products->sum("pivot.purchase");
$this->totalsale+=$sale->products->sum("pivot.amount");
}
$this->grossprofit=$this->totalsale-$this->cost;
$this->totalexpense=Payment::whereBetween("created_at",[$this->sdate,$this->edate])->where("client_id",2)->sum("credit");
$this->netprofit=$this->grossprofit-$this->totalexpense;
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
$sale=Sale::latest()->first();
$this->sdate=date("Y-m-d",strtotime($sale->created_at));
$this->edate=now()->format("Y-m-d");
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
return view('livewire.profitledger')->extends("layouts.wrapper");
}
}