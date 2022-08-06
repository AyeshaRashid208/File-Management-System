<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Models\Image;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $img_size = 0;


        foreach (File::allFiles(public_path('images')) as $file) {
            $img_size += $file->getSize();
        }


        $img_size = number_format($img_size / 1048576, 2);
        $size =$img_size . ' MB';
        //vedio
        $ved_size = 0;
        foreach (File::allFiles(public_path('vedios')) as $file) {
            $ved_size += $file->getSize();
        }


        $Vfile_size = number_format($ved_size / 1048576, 2);
        $vedio_size =$Vfile_size . ' MB';
        //docs
        $doc_size=0;
        foreach (File::allFiles(public_path('document')) as $file) {
            $doc_size += $file->getSize();
        }


        $Dfile_size = number_format($doc_size / 1048576, 2);
        $doc_size =$Dfile_size . ' MB';
        return view('home')
        ->with(compact('vedio_size'))
        ->with(compact('doc_size'))
        ->with(compact('size'));
    }
    
}
