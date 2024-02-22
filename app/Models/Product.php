<?php

namespace App\Models;

use App\Services\CurrencyService;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='product';

    protected $fillable=['name','price'];
    public $timestamps=false;

    public function getPriceEurAttribute(){
//        $product->price_eur
        return (new CurrencyService())->convert($this->price,'usd','eur');
    }
//    public function CreatedAt() : Attribute
//    {
//        return Attribute::make(
//            get: function (mixed $value, array $attributes){
//                return Carbon::parse($attributes['created_at'])->format('d/m/Y');
//            }
//        );
//    }
}
