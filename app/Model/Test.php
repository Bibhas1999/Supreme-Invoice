<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    public function dept()
    {
        return $this->belongsTo(Dept::class,'dept_id','id');
    }

    public function type()
    {
        return $this->belongsTo(Testtype::class,'type_id','id');
    }
}
