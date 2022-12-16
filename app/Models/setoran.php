<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class setoran extends Model
{
    use HasFactory;
    protected $fillable = [
        'nominal',
        'simpanan',
        'rekening',
        'keterangan',
        'tanggal',

    ];
}
