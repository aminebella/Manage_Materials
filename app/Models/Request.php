<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $primaryKey = 'id_request';

    protected $fillable = ['user_id', 'material_id', 'status'];//, 'date_request'

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id_user');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id', 'id_material');
    }
}

