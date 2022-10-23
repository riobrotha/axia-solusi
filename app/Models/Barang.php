<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barang';

    protected $guarded = ['id', 'created_at', 'updated_at'];



    public function created_by()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
