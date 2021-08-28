<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class UserAboutController extends Controller
{
    public function about_view(){
        $abouts = About::paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        return view('user.about.list')->with('abouts',$abouts);
    }
}
