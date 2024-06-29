<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Payment;
use App\Models\Stock;
use App\Models\Client;
use carbon\Carbon;
class Expenselist extends Component
{
public $classes=[],$title="Expense";
public $amount,$date,$description,$expenses;
public $sdate,$edate;
public $dsdate,$dedate;
public function delete($paymentid)
{
Payment::find($paymentid)->delete();
$this->search();
}
public function addpayment()
{
Payment::create([
"client_id"=>2,
"credit"=>$this->amount,
"description"=>$this->description,
"created_at"=>$this->date,
"updated_at"=>$this->date,
]);
$this->dispatchBrowserEvent("closemodal");
$this->amount="";
$this->search();
}
public function search()
{
$this->dsdate=$this->sdate;
$this->dedate=$this->edate;
$this->sdate=Carbon::parse($this->sdate)->startOfDay();
$this->edate=Carbon::parse($this->edate)->endOfDay();
$this->expenses=Payment::whereBetween("created_at",[$this->sdate,$this->edate])->where("client_id",2)->orderBy("created_at")->get();
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
$this->search();
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
return view('livewire.expenselist')->extends("layouts.wrapper");
}
}