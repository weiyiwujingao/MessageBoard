<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    public $timestamps = false;

    protected $table = 'message_content';

    protected $fillable = [
        'user_id', 'content'
    ];
}
