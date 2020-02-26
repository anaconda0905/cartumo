<?php

/**
 * return the user by user ID
 */
function get_the_user_by_email($email) {

    $user = App\Models\User::where( 'email', $email )->first();

    return $user;
}


function get_funnel_step($current_step_id, $step_type='product') {

    $step            = App\Models\FunnelStep::find( $current_step_id );
    $funnelStep      = App\Models\FunnelStep::where('funnel_id', $step->funnel_id)
                                            ->orderBy('funnel_id')
                                            ->first();

    return $funnelStep;
}

/**
 * get user products
 */
function get_user_products($user_id) {

    $products = App\Models\Products::where('user_id', $user_id)
                                    ->orderBy('id', 'DESC')
                                    ->get();

    return $products;                                    
}

/**
 * get products
 */
function get_products($funnel_id, $keyword='') {

    $funnel = App\Models\Funnel::find($funnel_id);

    if ( $funnel->type === 'manual' ) {

        $products = App\Models\Product::where('user_id', Auth::id())
                                        ->where('name', 'LIKE', '%' . $keyword . '%')
                                        ->orderBy('id', 'DESC')
                                        ->get();
    }

    return $products;
}