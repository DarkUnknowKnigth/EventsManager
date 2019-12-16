<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable=['concepto','monto','fecha','event_id'];
    public function event(){
        return $this->belongsTo('App\Event');
    }
}
