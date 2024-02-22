<?php

namespace App\Models;

use Astrotomic\Translatable\Translatable;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Adv extends Model implements TranslatableContract
{
    use Translatable, HasFactory;

    protected $table='advs';
    protected $guarded=[];
    public $translationModel=AdvTranslation::class;
    public $translatedAttributes = ['title','name'];
    protected $casts=['updated_at'=>'date:d/m/Y'];

    public function company()
    {
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function CreatedAt() : Attribute
    {
        return Attribute::make(
            get: function (mixed $value, array $attributes){
                return Carbon::parse($attributes['created_at'])->format('d/m/Y');
            }
        );
    }


}
