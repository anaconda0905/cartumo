<?php

namespace App\Models;

use Dompdf\Exception;
use Illuminate\Database\Eloquent\Model;

use App\Models\Product;
use App\Models\UserIntegration;

use Auth;

class StepProduct extends Model
{
    public function getProduct() {
        //return $this->belongsToOne('App\product');

		if ( $this->product_type == 'manual' ) {
			return Product::find(json_decode($this->details)->product_id);
		}
        else {
        	//return Product::find(json_decode($this->details)->product_id);

        	$userIntegration = UserIntegration::where('user_id', Auth::user()->id)->where('service_type', 'shopify')->first();
	        $json = json_decode($userIntegration->details);

	        $API_KEY = $json->api_key;
	        $API_PASSWORD = $json->password;
	        $SECRET = $json->shared_secret;
	        $store_name = $json->name;
	        $url = "https://" . $API_KEY . ":" . $API_PASSWORD . "@" . $store_name . ".myshopify.com/admin/products/" . json_decode($this->details)->product_id . ".json";
	        $shopify_data = "";

	        //return json_decode(file_get_contents($url));
	        if ( json_decode($this->details)->product_id != 'undefined' ) {
		        try {
			        $shopify_json_data = file_get_contents( $url );
			        $shopify_data      = json_decode( $shopify_json_data );
		        } catch ( Exception $exception ) {
			        $shopify_data = array();
		        }

		        return $shopify_data;
	        }

	        return $shopify_data;
        }
    }
}
