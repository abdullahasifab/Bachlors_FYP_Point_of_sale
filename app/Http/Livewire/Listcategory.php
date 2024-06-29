<?php
namespace App\Http\Livewire;
use App\Models\Category;
use Livewire\Component;
class Listcategory extends Component
{
public $name,$selectedid,$title="Category";
public function edit($id)
{
$this->selectedid=$id;
$category=Category::find($id);
$this->name=$category->name;
$this->dispatchBrowserEvent("openmodal");
}
public function delete($id)
{
$category=Category::find($id);
$category->products()->detach();
$category->delete();
session()->flash('smg', 'Category successfully Deleted.');
}
public function addcategory()
{
if($this->selectedid)
{
$this->validate(["name"=>"required"],
[
"name.required"=>"Category name is missing",
]);
Category::find($this->selectedid)->update(["name"=>$this->name]);
$this->selectedid=null;
}
else
{
$this->validate(["name"=>"required|unique:categories"],
[
"name.required"=>"Category name is missing",
"name.unique"=>"Category name already exist",
]);
Category::create(["name"=>$this->name]);
session()->flash('smg', 'Category successfully created.');
}
$this->name="";
$this->dispatchBrowserEvent("closemodal");
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
$categories=Category::latest()->get();
return view('livewire.listcategory',compact("categories"))->extends("layouts.wrapper");
}
}