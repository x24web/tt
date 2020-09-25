<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class blogs extends Model
{
    protected $fillable = [
        'title', 'views', 'views_month','body','img','slug','public_time','keyword','description','is_public'
    ];
}
