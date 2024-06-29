<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function client()
    {
        return $this->belongsTo("App\Models\Client");
    }

    public function stock()
    {
        return $this->belongsTo("App\Models\Stock");
    }

    public function sale()
    {
        return $this->belongsTo("App\Models\Sale");
    }




    public function getDateAttribute()
    {
        if ($this->created_at) {
            return $this->created_at->format("d-m-Y");
        }

        return null; // or return a default value or handle it as required
    }

}
