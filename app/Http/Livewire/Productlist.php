<?php
namespace App\Http\Livewire;
use App\Models\Product;
use App\Models\Category;
use Livewire\Component;
class Productlist extends Component
{
public $name,$purchase,$sale,$flag=0,$cats=[],$barcode;
public $classes=[],$title="Product";
public function removecategory($pid,$cid)
{
Product::find($pid)->categories()->detach($cid);
}
public function clearfields()
{
$this->name="";
$this->purchase="";
$this->sale="";
$this->cats=[];
$this->barcode="";
}
public function create()
{
if($this->flag>0)
{
$this->flag=0;
$this->clearfields();
}
$this->dispatchBrowserEvent("openmodal");
}
public function edit($id)
{
$product=Product::find($id);
$this->name=$product->name;
$this->purchase=$product->purchase;
$this->sale=$product->sale;
$this->barcode=$product->barcode;
foreach($product->categories as $category)
{
$this->cats[]=$category->id;
}
$this->flag=$id;
$this->dispatchBrowserEvent("openmodal");
}
public function delete($id)
{
Product::find($id)->delete();
}
public function addproduct()
{
$messages=[
"name.required"=>"Product Name is required",
"purchase.required"=>"Purchase Price is missing",
"sale.required"=>"Sale Price is missing",
"sale.numeric"=>"Sale Price must be a number",
"purchase.numeric"=>"Purchase Price must be a number",
];
$this->validate([
"name"=>"required",
"purchase"=>"required|numeric",
"sale"=>"required|numeric",
],$messages);
if($this->flag)
{
Product::find($this->flag)->update([
"name"=>$this->name,
"purchase"=>$this->purchase,
"sale"=>$this->sale,
]);
$product=Product::find($this->flag);
$product->categories()->detach();
foreach($this->cats as $cat)
$product->categories()->attach($cat);
$this->flag=0;
}
else
{
$this->validate([
"name"=>"unique:products",
],["name.unique"=>"Product with this name already in List"]);
$product=Product::create([
"name"=>$this->name,
"purchase"=>$this->purchase,
"sale"=>$this->sale,
"barcode"=>$this->barcode,
]);
foreach($this->cats as $cat)
$product->categories()->attach($cat);
}
$this->dispatchBrowserEvent("closemodal");
$this->clearfields();
}
public function mount()
{
$this->classes[]="bg-gradient-success toast-btn";
$this->classes[]="bg-gradient-danger toast-btn";
$this->classes[]="bg-gradient-dark toast-btn";
$this->classes[]="bg-gradient-info toast-btn";
$this->classes[]="bg-gradient-warning toast-btn";
$this->classes[]="bg-gradient-success toast-btn";
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
$products=Product::latest()->with("categories")->get();
$categories=Category::all();
return view('livewire.productlist',compact("products","categories"))->extends("layouts.wrapper");
}
}