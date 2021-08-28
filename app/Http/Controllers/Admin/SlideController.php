<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slide;
use App\Traits\StorageUploadFile;
use Illuminate\Http\Request;

class SlideController extends Controller
{   
    use StorageUploadFile;
    private $slide;
    public function __construct(Slide $slide)
    {
        $this->slide = $slide;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = $this->slide->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        return view('admin.slide.list')->with('sliders',$sliders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.slide.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->slide->Store($request);
        return redirect()->route('slide.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function edit(Slide $slide)
    {
        return view('admin.slide.edit',[
            'slider'=>$slide
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slide $slide)
    {
        $this->slide->UpdateSlider($request,$slide);
        return redirect()->route('slide.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Slide  $slide
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slide $slide)
    {
        $slide->delete();
        return redirect()->route('slide.index');
    }
}
