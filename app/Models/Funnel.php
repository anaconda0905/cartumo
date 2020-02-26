<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Funnel extends Model
{
	// //////////////////////////////////////////////
    // Member Functions
    // //////////////////////////////////////////////


    
	// //////////////////////////////////////////////
    // Relations
    // //////////////////////////////////////////////

    public function steps()
    {
    	return $this->hasMany("App\Models\FunnelStep");
    }


    public function paymentGateway() {
        return $this->hasOne("App\Models\UserPaymentGateway");
    }

    public function user() {
        return $this->belongsTo("App\Models\User");
    }
}
