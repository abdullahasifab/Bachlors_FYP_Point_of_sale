<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $guarded=[];
    use HasFactory;

    public function categories()
    {
        return $this->belongsToMany("App\Models\Category");

    }

    public function stocks()
    {
        return $this->belongsToMany("App\Models\Stock")->withPivot("quantity","amount");
    }

    public function sales()
    {
        return $this->belongsToMany("App\Models\Sale")->withPivot("quantity","amount","purchase");
    }
}
