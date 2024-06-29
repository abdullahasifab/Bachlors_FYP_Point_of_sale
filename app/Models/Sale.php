<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function payment()
    {
        return $this->hasOne("App\Models\Payment");
    }

    public function products()
    {
        return $this->belongsToMany("App\Models\Product")->withPivot("quantity","amount","purchase");
    }

    public function client()
    {
        return $this->belongsTo("App\Models\Client");
    }

    public function getAmountAttribute()
    {
        
        $amount=$this->products->sum("pivot.amount");
        return $amount;
    }

    public function getDetailAttribute()
    {
        
        $products=$this->products;
        $detail="";
         foreach($products as $index=>$product)
        {

            $count=$index+1;

            $detail.=$count.". ".$product->name." Quantity ".$product->pivot->quantity." Amount ".$product->pivot->amount."<br>";
            if($count==3) break;
        }
        if(count($products)>3) $detail.="<i wire:click='showdetail($this->id)' role='button' class='bi bi-file-earmark-text'></i>Details";
        return $detail;
    }

    public function getDateAttribute()
    {
        return $this->created_at->format("d-m-Y");
    }
}
