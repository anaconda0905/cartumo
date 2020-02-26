<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HelpCenterTopic extends Model
{
    public function category() {
        return $this->belongsTo('App\Models\HelpCenterCategory');
    }
}
