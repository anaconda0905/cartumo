<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function payment()
    {
    	return $this->hasOne("App\Models\ProductPayment");
    }

    public function options()
    {
    	return $this->hasMany("App\Models\ProductOption");
    }
}
