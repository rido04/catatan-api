<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;

    // ✅ Tambahkan fillable untuk mengizinkan mass assignment
    protected $fillable = ['user_id', 'title', 'content'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // sembunyinkan timestamps
    protected $hidden = ['created_at', 'updated_at'];
}
