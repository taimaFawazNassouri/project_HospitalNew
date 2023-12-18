<?php

namespace App\Models;
use Astrotomic\Translatable\Translatable;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Service;

class Group extends Model
{
    use HasFactory;
    use Translatable; // 2. To add translation methods
    protected $fillable= ['Total_before_discount','Total_after_discount','discount_value','Total_with_tax','tax_rate'];

    // 3. To define which attributes needs to be translated
    public $translatedAttributes = ['name','notes'];

    
    public function service_group()
    {
        return $this->belongsToMany(Service::class,'service_group');
    }
}
