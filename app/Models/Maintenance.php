<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = 'maintenances';
    protected $primaryKey = 'id_maintenance';

    protected $fillable = ['user_id', 'material_id', 'status'];//'date_maintenance'

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }
}

