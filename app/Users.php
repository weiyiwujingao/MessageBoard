<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    public $timestamps = false;

    protected $table = 'user';

    public $primaryKey = 'user_id';

    protected $fillable = [
        'user_name', 'user_password', 'user_email'
    ];
}
