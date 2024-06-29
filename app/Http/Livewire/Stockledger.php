<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Product;
use App\Models\Client;
use Carbon\Carbon;
class Stockledger extends Component
{
public $classes=[],$title="",$productid;
public $sdate,$edate;
public $dsdate,$dedate;
public $totalsale,$totalpurchase,$inhand;
protected $items;
public function search()
{
$this->totalpurchase=0;
$this->totalsale=0;
$this->inhand=0;
$this->validate([
"productid"=>"required",
]);
$this->dsdate=$this->sdate;
$this->dedate=$this->edate;
$this->sdate=Carbon::parse($this->sdate)->startOfDay();
$this->edate=Carbon::parse($this->edate)->endOfDay();
$product=Product::find($this->productid);
$collection=collect();
$product->stocks()->whereBetween("stocks.created_at",[$this->sdate,$this->edate])->with("client","products")
->each(function($stock) use($collection) {
$collection->push([
"date"=>$stock->created_at->format("Y-m-d"),
"detail"=>"Purchase From ".$stock->client->name,
"purchase"=>$stock->products->where("id",$this->productid)->first()->pivot->quantity,
"sale"=>0,
]);
$this->totalpurchase+=$stock->products->where("id",$this->productid)->first()->pivot->quantity;
});
$product->sales()->whereBetween("sales.created_at",[$this->sdate,$this->edate])->with("client","products")
->each(function($sale) use($collection) {
$collection->push([
"date"=>$sale->created_at->format("Y-m-d"),
"detail"=>"Sale to  ".$sale->client->name,
"purchase"=>0,
"sale"=>$sale->products->where("id",$this->productid)->first()->pivot->quantity,
]);
$this->totalsale+=$sale->products->where("id",$this->productid)->first()->pivot->quantity;
});
$this->inhand=$this->totalpurchase-$this->totalsale;
$collection1=$collection->sortBy("date");
$this->items=json_decode($collection1);
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
$products=Product::has("stocks")->get();
$items=$this->items;
return view('livewire.stockledger',compact("products","items"))->extends("layouts.wrapper");
}
}