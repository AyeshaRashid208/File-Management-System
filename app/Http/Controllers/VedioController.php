<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Vedio;
use Auth;
class VedioController extends Controller
{
    public function index()

    {
        $id = Auth::user()->id;
        $var = Vedio::where('user_id', $id)->get();
        $count = $var->count();
        $file_size = 0;


        foreach (File::allFiles(public_path('vedios')) as $file) {
            $file_size += $file->getSize();
        }


        $file_size = number_format($file_size / 1048576, 2);
        $size =$file_size . ' MB';
        //  dd($size);
        return view('vedios.index')
        ->with(compact('size'))
        ->with(compact('count'));
    }
    // public function upload()
    // {
    //     return redirect()->back();
    // }
    public function upload(Request $request)
    {

        
        $validatedData = $request->validate([
            'vedio' => 'required|file|mimes:x-flv,mp4,MP2T',

        ]);

       
        

        $vedio = $request->file('vedio');
        // dd($vedio);
        $extension = $vedio->getClientOriginalExtension(); //Getting extension
        // dd($extension);
        $originalname = $vedio->getClientOriginalName(); //Getting original name
        // dd($originalname);
        $path = $vedio->move('vedios', $originalname); //This will store in customize folder

        $imgsizes = $path->getSize();

        $data = getimagesize($path);
        // $size = $request->file('image')->getSize();
        // $bytes = File::size($image);
        // dd($size);
        

        $mimetype = $vedio->getClientMimeType(); //Get MIME type
        // dd($mimetype);
        //Start Store in Database
        $picture = new  Vedio();
        $id = Auth::user()->id;
        // $picture->mime = $mimetype;
        $picture->vedsize = $imgsizes;
        $picture->original_filename = $originalname;
        $picture->extension = $extension;
        $picture->filename = $path;
        $picture->user_id = $id;
        $picture->save();

        return redirect()->back()->with('status', 'Vedio Has been uploaded');
    }
}


