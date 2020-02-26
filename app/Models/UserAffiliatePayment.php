<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\AffiliateProfile;

class UserAffiliatePayment extends Model
{
	public function getProfile($user_id) {
		return AffiliateProfile::where('user_id', $user_id)->first();
	}
}
