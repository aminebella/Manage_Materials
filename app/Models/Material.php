<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $table = 'materials';
    protected $primaryKey = 'id_material';

    protected $fillable = ['type_id', 'brand_id', 'name', 'status', 'user_id'];

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id_type');
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id_brand');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function requests()
    {
        return $this->hasMany(Request::class, 'material_id', 'id_material');
    }

    public function maintenances()
    {
        return $this->hasMany(Maintenance::class, 'material_id', 'id_material');
    }
}

