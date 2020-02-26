<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public function orderDetails()
    {
    	return $this->hasOne("App\Models\OrderDetail");
    }

    public function orderProduct()
    {
    	return $this->hasOne("App\Models\OrderProducts");
    }
}
