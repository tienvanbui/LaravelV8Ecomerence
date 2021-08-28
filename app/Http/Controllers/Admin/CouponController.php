<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coupons = Coupon::paginate(20);
        return view('admin.coupon.list')->with('coupons',$coupons);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $coupon  = new Coupon();
        $coupon->fill($request->all());
        $coupon->save();
        return redirect()->route('coupon.index')->with('message','Created new coupon successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit')->with('coupon',$coupon);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coupon $coupon)
    {
        $coupon->update($request->all());
        return redirect()->route('coupon.index')->with('message', 'Updated  coupon successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Coupon  $coupon
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->route('coupon.index')->with('message', 'Deleted  coupon successfully!');
    }
    public function check_coupon(Request $request){
            $coupon = Coupon::where('coupon_code', $request->coupon_code)->first();
        if( $coupon != null){
            session(['discount_type'=>$coupon->coupon_codition, 'coupon_code' => $coupon->coupon_code, 'price_discount'=>$coupon->coupon_price_discount]);
            return redirect()->route('payment.confirm')->with('coupon_message_success','Your order will be discount!');
        }
        return redirect()->route('payment.confirm')->with('coupon_message_fail', 'Opp!The Discount Code Does Not Exist Or Can Only Be Used Once');
    }
}
