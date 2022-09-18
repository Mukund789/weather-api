<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $primaryKey = 'id';
    protected $fillable = ['name','latitude','longitude','state','country',];
    protected $table = 'city';
}
