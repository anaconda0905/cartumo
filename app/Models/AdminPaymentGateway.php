<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminPaymentGateway extends Model
{
    //
    public function admin() {
        return $this->belongsTo('App\Models\Admin');
    }
}
