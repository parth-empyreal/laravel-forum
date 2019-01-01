<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $fillable = [
        'content', 'created_by', 'thread_id'
    ];

    public function Owner(){
    	return $this->belongsTo(User::class,'created_by');
    }

    public function Thread(){
    	return $this->belongsTo(Threads::class,'thread_id');
    }
}
