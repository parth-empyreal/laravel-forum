<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Threads extends Model
{
    protected $fillable = [
        'title', 'content', 'created_by',
    ];

    public function Owner(){
    	return $this->belongsTo(User::class,'created_by');
    }
}
