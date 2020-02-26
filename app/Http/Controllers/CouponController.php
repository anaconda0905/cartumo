<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Coupon;

use Auth;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data['coupons'] = Coupon::where('user_id', Auth::user()->id)->orderBy('id', 'desc')->paginate(20);

        return view('coupon.list')->withData($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();
        $coupon->user_id = Auth::user()->id;
        $coupon->coupon_name = $request->input('coupon_name');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->discount = $request->input('discount');
        $coupon->date_start = $request->input('date_start');
        $coupon->date_end = $request->input('date_end');
        $coupon->status = $request->input('status');
        $coupon->save();

        return redirect()->route('coupon.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['coupon'] = Coupon::find($id);

        return view('coupon.edit')->withData($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['coupon'] = Coupon::find($id);

        return view('coupon.edit')->withData($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $coupon = Coupon::find($id);
        $coupon->user_id = Auth::user()->id;
        $coupon->coupon_name = $request->input('coupon_name');
        $coupon->coupon_code = $request->input('coupon_code');
        $coupon->discount = $request->input('discount');
        $coupon->date_start = $request->input('date_start');
        $coupon->date_end = $request->input('date_end');
        $coupon->status = $request->input('status');
        $coupon->save();

        return redirect()->route('coupon.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $coupon = Coupon::find($id);

        if ( $coupon->delete() ) {
            die(
                json_encode(
                    array(
                        'status'    => 'success',
                    )
                )
            );
        }
    }
}
