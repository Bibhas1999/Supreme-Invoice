<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetails extends Model
{

  public function test()
  {
      return $this->belongsTo(Test::class,'test_id','id');
  }
}
