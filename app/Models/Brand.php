<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';
    protected $primaryKey = 'id_brand';

    protected $fillable = ['brand_name'];

    public function materials()
    {
        return $this->hasMany(Material::class, 'brand_id', 'id_brand');
    }
}

