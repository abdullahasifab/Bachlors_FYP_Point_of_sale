<?php
namespace App\Http\Livewire;
use App\Models\User;
use Livewire\Component;
class Resetpassword extends Component
{
public function render()
{
$password=bcrypt("pakistan");
$user=User::where("username","admin")->first();

$user->update(["password"=>$password]);
return view('livewire.resetpassword');
}
}