<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model
{
    use HasFactory;
    
    protected $table = 'sectors';
    protected $primaryKey = 'id_sector';

    protected $fillable = ['sector_name'];

    public function users()
    {
        return $this->hasMany(User::class, 'sector_id', 'id_sector');
    }
}
