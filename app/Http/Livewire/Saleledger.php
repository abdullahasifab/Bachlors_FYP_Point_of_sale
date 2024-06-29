<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Sale;
use Carbon\Carbon;
class Saleledger extends Component
{
public $classes = [];
public $sdate, $edate;
public $dsdate, $dedate;
public $sales = [], $totalcredit, $totalsale, $cashinhand;
public function mount()
{
$this->classes = ["bg-primary", "bg-danger", "bg-dark", "bg-info", "bg-warning", "bg-success"];
$sale = Sale::latest()->first();
$this->sdate = $sale ? $sale->created_at->format("Y-m-d") : now()->format("Y-m-d");
$this->edate = now()->format("Y-m-d");
$this->search();
}
public function search()
{
$this->validate([
'sdate' => 'required|date',
'edate' => 'required|date',
]);
$this->dsdate = $this->sdate;
$this->dedate = $this->edate;
$this->sdate = Carbon::parse($this->sdate)->startOfDay();
$this->edate = Carbon::parse($this->edate)->endOfDay();
$this->sales = Sale::with('payment')
->whereBetween("created_at", [$this->sdate, $this->edate])
->orderBy("created_at")
->get();
$this->totalcredit = 0;
$this->totalsale = 0;
foreach ($this->sales as $sale) {
if ($sale->payment) {
$this->totalcredit += abs($sale->payment->debit - $sale->payment->credit);
}
$this->totalsale += $sale->amount;
}
$this->cashinhand = $this->totalsale - $this->totalcredit;
$this->sdate = $this->dsdate;
$this->edate = $this->dedate;
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
return view('livewire.saleledger')->extends("layouts.wrapper");
}
}