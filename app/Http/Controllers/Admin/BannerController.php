<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Traits\StorageUploadFile;
use Illuminate\Http\Request;


class BannerController extends Controller
{   
    use StorageUploadFile;
    private $banner;

    public function __construct(Banner $banner)
    {
        $this->banner = $banner;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = $this->banner->latest()->paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        return view('admin.banner.list')->with('banners',$banners);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataCreate = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        $data = $this->UploadFile($request, 'thumb', 'banners', 1200, 809);
        if (!empty($data)) {
            $dataCreate['thumb'] = $data['filePath'];
        }
        $banner  = Banner::create(
            $dataCreate
        );
        return redirect()->route('banner.index')->with('message', 'Created Banner Infor successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        return view('admin.banner.edit')->with('banner', $banner);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $dataUpdate = [
            'title' => $request->title,
            'content' => $request->content,
        ];
        $data = $this->UploadFile($request, 'thumb', 'banners', 1200, 809);
        if (!empty($data)) {
            $dataUpdate['thumb'] = $data['filePath'];
        }
        $banner  = $banner->update(
            $dataUpdate
        );
        return redirect()->route('banner.index')->with('message', 'Updated Banner Infor successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banner.index')->with('message', 'Deleted Banner Infor successfully!');
    }
}
