<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Referal extends Model
{
    // protected $table    = 'referal_emails';
    protected $fillable = ['user_id','referal_email', 'referal_id'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'id');
    }
}