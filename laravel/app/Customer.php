<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model {
    protected $fillable = [
        'name', 'address','email','user_id',
    ];

    protected $hidden = [];

    //
}
