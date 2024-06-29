<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Product;
class Stockinhand extends Component
{
public function render()
{
$products=Product::all();
$collection=collect();
foreach($products as $product)
{
$pname=$product->name;
$in=$product->stocks->sum("pivot.quantity");
$out=$product->sales->sum("pivot.quantity");
$inhand=$in-$out;
$collection->push([
"product"=>$pname,
"purchase"=>$in,
"sale"=>$out,
"inhand"=>$inhand,
]);
}
$collection1=$collection->sortBy("inhand");
$items=json_decode($collection1);
return view('livewire.stockinhand',compact("items"))->extends("layouts.wrapper");
}
}