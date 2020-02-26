<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\TemplateType;

class PageTemplate extends Model
{
    public function getCategory($id)
    {
        return TemplateType::find($id);
    }


    public function developer($id) {
        return $this->belongsTo('App\Models\Developer');
    }
}
