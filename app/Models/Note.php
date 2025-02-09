<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    // ✅ Tambahkan fillable untuk mengizinkan mass assignment
    protected $fillable = ['title', 'content'];

    // sembunyinkan timestamps
    protected $hidden = ['created_at', 'updated_at'];
}
