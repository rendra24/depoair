<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KartuTemp extends Model
{
    use HasFactory;
    protected $table = 'kartu_temp';
    protected $guarded = ['id'];
    public $timestamps = false;
}