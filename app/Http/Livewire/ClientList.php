<?php
namespace App\Http\Livewire;
use App\Models\Client;
use Livewire\Component;
class ClientList extends Component
{
public $title="Client",$flag=0,$name,$contact,$address,$ctype,$selectedtype="all";
public function delete($id)
{
Client::find($id)->delete();
}
public function clearfields()
{
$this->name="";
$this->contact="";
$this->address="";
$this->ctype="";
}
public function edit($id)
{
$client=Client::find($id);
$this->name=$client->name;
$this->contact=$client->contact;
$this->address=$client->address;
$this->ctype=$client->ctype;
$this->flag=$id;
$this->dispatchBrowserEvent("openmodal");
}
public function addvendor()
{
$id=Client::orderBy("id","DESC")->first()->id;
if($id<6) $id=6; else $id++;
if($this->flag)
{
Client::find($this->flag)->update([
"name"=>$this->name,
"contact"=>$this->contact,
"address"=>$this->address,
]);
$this->flag=0;
}
else {
Client::create([
"id"=>$id,
"name"=>$this->name,
"contact"=>$this->contact,
"address"=>$this->address,
"ctype"=>$this->ctype,
]);
}
$this->clearfields();
$this->dispatchBrowserEvent("closemodal");
}
public function render()
{
$this->dispatchBrowserEvent("maketable");
if($this->selectedtype=="all")
$clients=Client::where("id",">",5)->latest()->get();
elseif($this->selectedtype=="vendors")
$clients=Client::where("ctype",1)->where("id",">",5)->latest()->get();
else
$clients=Client::where("ctype",0)->where("id",">",5)->latest()->get();
return view('livewire.clientlist',compact("clients"))->extends("layouts.wrapper");
}
}
