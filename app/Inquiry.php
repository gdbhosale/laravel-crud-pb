<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inquiry extends Model
{
    protected $table = 'inquiries';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'ref'
    ];
}
