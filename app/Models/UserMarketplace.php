<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMarketplace extends Model
{
    protected $guarded = [];

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    public function funnel() {
        return $this->belongsTo('App\Models\Funnel');
    }
}
