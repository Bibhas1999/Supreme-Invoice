<?php

namespace App\Model;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function dept()
    {
        return $this->belongsTo(Dept::class,'dept_id','id');
    }
}
