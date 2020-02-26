<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\UserAffiliatePayment;

class AffiliateProfile extends Model {

	public function user() {

		return $this->belongsTo('App\Models\User');
	}

	public function payments() {
		return $this->hasMany('App\Models\UserAffiliatePayment');
	}

	public function getSales( $user_id ) {

		return UserAffiliatePayment::where( 'user_id', $user_id )->orderBy( 'id' )->get();
	}

	public function getPaidPendingAmount( $user_id ) {

		$sales   = UserAffiliatePayment::where( 'user_id', $user_id )->orderBy( 'id' )->get();
		$paid    = 0.0;
		$pending = 0.0;

		foreach ( $sales as $sale ) {
			if ( $sale->status ) {
				$paid += $paid + $sale->amount;
			} else {
				$pending += $pending + $sale->amount;
			}
		}

		return array( 'paid' => $paid, 'pending' => $pending );
	}


	public function getTotalEarnings( $user_id, $date_span = 0 ) {

		$total = 0.0;

		if ( $date_span > 0 ) {

			for ( $i = 1; $i <= $date_span; $i ++ ) {

				$date_filter = date( 'Y-m-d', strtotime( '-' . $i . ' days' ) );
				$sales       = UserAffiliatePayment::where( 'user_id', $user_id )
				                                   ->whereDate( 'created_at', '=', date( 'Y-m-d', strtotime( $date_filter ) ) )->get();
				if ( $sales->count() > 0 ) {
					foreach ( $sales as $sale ) {
						if ( $sale->status ) {
							$total += $total + $sale->amount;
						}
					}
				}
			}
		} else {

			$sales = UserAffiliatePayment::where( 'user_id', $user_id )
			                             ->whereDate( 'created_at', '=', date( 'Y-m-d' ) )->get();
			if ( $sales->count() > 0 ) {
				foreach ( $sales as $sale ) {
					if ( $sale->status ) {
						$total += $total + $sale->amount;
					}
				}
			}
		}

		return $total;
	}


	public function getLastWeekEarnings( $user_id ) {

		$total_earnings = array();

		for ( $i = 1; $i <= 7; $i ++ ) {

			$date_filter = date( 'Y-m-d', strtotime( '-' . $i . ' days' ) );
			$sales       = UserAffiliatePayment::where( 'user_id', $user_id )
			                                   ->whereDate( 'created_at', '=', date( 'Y-m-d', strtotime( $date_filter ) ) )->get();
			if ( $sales->count() > 0 ) {

				$total = 0.0;

				foreach ( $sales as $sale ) {
					if ( $sale->status ) {
						$total += $total + $sale->amount;
					}
				}

				$total_earnings[] = $total;
			} else {
				$total_earnings[] = 0.00;
			}
		}

		return $total_earnings;
	}
}
