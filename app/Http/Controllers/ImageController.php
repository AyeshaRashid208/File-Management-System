<?php

namespace App\Http\Controllers;
// use File;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use App\Models\Image;
use Auth;

class ImageController extends Controller
{
    public function index()

    {
        $id = Auth::user()->id;
        $var = Image::where('user_id', $id)->get();
        $count = $var->count();
        $file_size = 0;


        foreach (File::allFiles(public_path('images')) as $file) {
            $file_size += $file->getSize();
        }


        $file_size = number_format($file_size / 1048576, 2);
        $size =$file_size . ' MB';
        //  dd($size);
        return view('images.index')
        ->with(compact('size'))
        ->with(compact('count'));
    }
    // public function upload()
    // {
    //     return redirect()->back();
    // }
    public function upload(Request $request)
    {
        // $id = Auth::user()->id;
        // dd($id);
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif',

        ]);

        // $name = $request->file('image')->getClientOriginalName();

        // $path = $request->file('image')->store('public/image');


        // $save = new Image;

        // $save->name = $name;
        // $save->path = $path;

        // $save->save();
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $image = $request->file('image');

        $extension = $image->getClientOriginalExtension(); //Getting extension
        // dd($extension);
        $originalname = $image->getClientOriginalName(); //Getting original name
        // dd($originalname);
        $path = $image->move('images', $originalname); //This will store in customize folder

        $imgsizes = $path->getSize();

        $data = getimagesize($path);
        // $size = $request->file('image')->getSize();
        // $bytes = File::size($image);
        // dd($size);
        $width = $data[0];
        $height = $data[1];

        $mimetype = $image->getClientMimeType(); //Get MIME type
        // dd($mimetype);
        //Start Store in Database
        $picture = new  Image();
        $id = Auth::user()->id;
        // $picture->mime = $mimetype;
        $picture->imgsize = $imgsizes;
        $picture->original_filename = $originalname;
        $picture->extension = $extension;
        $picture->filename = $path;
        $picture->user_id = $id;
        $picture->save();
        \Storage::disk('google')->put( $originalname, $image);

        return redirect()->back()->with('status', 'Image Has been uploaded');
    }
}
