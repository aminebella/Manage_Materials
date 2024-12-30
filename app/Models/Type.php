<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    protected $table = 'types';
    protected $primaryKey = 'id_type';

    protected $fillable = ['type_name'];

    public function materials()
    {
        return $this->hasMany(Material::class, 'type_id', 'id_type');
    }
}

