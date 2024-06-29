<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Stock;
class Stocklist extends Component
{
public $title="Stock",$stockdata=[];
public function delete($id)
{
$stock=Stock::find($id);
$stock->payment()->delete();
$stock->products()->detach();
$stock->delete();
}
public function showdetail($id)
{
$this->stockdata=Stock::find($id);
$this->dispatchBrowserEvent("openmodal");
}
public function render()
{
$stocks=Stock::latest()->get();
$this->dispatchBrowserEvent("maketable");
return view('livewire.stocklist',compact("stocks"))
->extends("layouts.wrapper");
}
}
