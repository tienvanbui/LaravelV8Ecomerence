<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Traits\StorageUploadFile;
use Illuminate\Http\Request;

class AboutController extends Controller
{   
    use StorageUploadFile;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $abouts = About::paginate(config('appConst.appConst.PRODUCT_IN_PER_PAGE'));
        return view('admin.about.list')->with('abouts',$abouts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dataUpload = [
            'title'=>$request->title,
            'des' => $request->des,
            'qoute' => $request->qoute,
        ];
        $data = $this->UploadFile($request, 'thumbnail', 'abouts', 509, 509);
        if (!empty($data)) {
            $dataUpload['thumbnail'] = $data['filePath'];
        }
        $about  = About::create(
            $dataUpload
        );
        return redirect()->route('about.index')->with('message', 'Created About Infor successfully!');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function edit(About $about)
    {
        return view('admin.about.edit')->with('about', $about);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, About $about)
    {
        $dataUpload = [
            'title' => $request->title,
            'des' => $request->des,
            'qoute' => $request->qoute,
        ];
        $data = $this->UploadFile($request, 'thumbnail', 'abouts', 509, 509);
        if (!empty($data)) {
            $dataUpload['thumbnail'] = $data['filePath'];
        }
        $about->update(
            $dataUpload
        );
        return redirect()->route('about.index')->with('message', 'Updated About Infor successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\About  $about
     * @return \Illuminate\Http\Response
     */
    public function destroy(About $about)
    {
        $about->delete();
        return redirect()->route('about.index')->with('message', 'Deleted About Infor successfully!');
    }
}
