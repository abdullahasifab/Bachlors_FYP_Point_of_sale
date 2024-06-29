<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function stocks()
    {
        return $this->hasMany("App\Models\Stock");
    }

    public function sales()
    {
        return $this->hasMany("App\Models\Sale");
    }

    public function getClienttypeAttribute()
    {
         $this->ctype? $c="Vendor": $c="Customer";
         return $c;
    }

    public function payments()
    {
        return $this->hasMany("App\Models\Payment");
    }
}
