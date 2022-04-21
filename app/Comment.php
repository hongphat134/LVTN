<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $table = 'comment';

    // public $timestamps = false;

    const CREATED_AT = 'created_at';

    const UPDATED_AT = null;
}
