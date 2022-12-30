<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use Illuminate\Testing\Fluent\Concerns\HasApiTokens;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Contracts\Auth\Authenticatable;


class Anggota extends  Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'pekerjaan',
        'nomor_anggota',
        'tempat_tinggal',
        'tanggungan',
        'penghasilan'

    ];
}
