<?php
namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
class Usermanagement extends Component
{
public $username,$role=2,$password;
public $flag=0;
public function edit($id)
{
$this->flag=$id;
$user=User::find($id);
$this->username=$user->username;
$this->role=$user->role;
$this->password=$user->password;
}
public function delete($id)
{
$user=User::find($id);
if($user->username!="admin")
$user->delete();
}
public function adduser()
{
if($this->flag)
{
if(strlen($this->password)!=60) $this->password=bcrypt($this->password);
User::find($this->flag)->update([
"username"=>$this->username,
"role"=>$this->role,
"password"=>$this->password,
]);
}
else {
$this->password=bcrypt($this->password);
User::create([
"username"=>$this->username,
"role"=>$this->role,
"password"=>$this->password,
]);
}
$this->role=2;
$this->username="";
$this->password="";
$this->flag=0;
}
public function render()
{
if(auth()->user()->username!="admin")
return view("home");
$users=User::all();
return view('livewire.usermanagement',compact("users"))->extends("layouts.wrapper");
}
}