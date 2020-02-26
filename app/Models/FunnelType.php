<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FunnelType extends Model
{
    public function step()
    {
        return $this->belongsTo("App\Models\FunnelStep");
    }

    public static function getIcon($type_id) {

        $type = FunnelType::find($type_id);

        switch (strtolower($type->name)) {
            case 'product': return '<i class="fa fa-cube" aria-hidden="true"></i>';
            case 'order': return '<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
            case 'upsell': return '<i class="fa fa-arrow-up" aria-hidden="true"></i>';
            case 'downsell': return '<i class="fa fa-arrow-down" aria-hidden="true"></i>';
            case 'confirmation': return '<i class="fa fa-download" aria-hidden="true"></i>';
            case 'sales': return '<i class="fa fa-usd" aria-hidden="true"></i>';
            case 'optin': return '<i class="fa fa-user-circle" aria-hidden="true"></i>';
        }
    }


    public static function getTypeName($type_id) {

        $type = FunnelType::find($type_id);

        return $type->name;
    }
}
