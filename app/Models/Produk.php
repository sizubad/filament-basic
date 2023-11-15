<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Produk extends Model
{
    use HasFactory;
    protected $fillable = ['kategori_id','brand_id', 'nama', 'deskripsi', 'gambar', 'ukuran','harga','stok'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class);
    }

    
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
}
