<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Marksheet extends Model
{
    protected $table='marksheet';
    protected $guarded = [
        'id'
    ];
}
