<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HostIP extends Model
{
    use HasFactory;

    protected $fillable = ['host', 'ip'];
}
