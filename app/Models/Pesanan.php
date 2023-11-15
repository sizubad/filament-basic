<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pesanan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','produk_id', 'alamat', 'catatan', 'total_harga', 'tanggal_pesanan','status'];
   
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    
    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class);
    }
}

