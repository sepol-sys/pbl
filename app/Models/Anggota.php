<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Testing\Fluent\Concerns\HasApiTokens;

class Anggota extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'pekerjaan',
        'nomor_anggota',
        'tempat_tinggal',
        'tanggungan',
        'penghasilan'

    ];
}
