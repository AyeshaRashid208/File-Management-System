<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\File;

use Illuminate\Http\Request;
use App\Models\Document;
use Auth;
class DocumentController extends Controller
{
    public function index()

    {
        $id = Auth::user()->id;
        $var = Document::where('user_id', $id)->get();
        $count = $var->count();
        $file_size = 0;


        foreach (File::allFiles(public_path('document')) as $file) {
            $file_size += $file->getSize();
        }


        $file_size = number_format($file_size / 1048576, 2);
        $size =$file_size . ' MB';
        //  dd($size);
        return view('doc.index')
        ->with(compact('size'))
        ->with(compact('count'));
    }
    // public function upload()
    // {
    //     return redirect()->back();
    // }
    public function upload(Request $request)
    {
        // dd('123');
        
        $validatedData = $request->validate([
            'document' => 'required|file|mimes:pdf,docs,csv,xlsx,xls,doc',

        ]);

       
        

        $document = $request->file('document');
        // dd($vedio);
        $extension = $document->getClientOriginalExtension(); //Getting extension
        // dd($extension);
        $originalname = $document->getClientOriginalName(); //Getting original name
        // dd($originalname);
        $path = $document->move('document', $originalname); //This will store in customize folder

        $imgsizes = $path->getSize();

        $data = getimagesize($path);
        // $size = $request->file('image')->getSize();
        // $bytes = File::size($image);
        // dd($size);
        

        $mimetype = $document->getClientMimeType(); //Get MIME type
        // dd($mimetype);
        //Start Store in Database
        $picture = new  Document();
        $id = Auth::user()->id;
        // $picture->mime = $mimetype;
        $picture->size = $imgsizes;
        $picture->original_filename = $originalname;
        $picture->extension = $extension;
        $picture->filename = $path;
        $picture->user_id = $id;
        $picture->save();

        return redirect()->back()->with('status', 'Document Has been uploaded');
    }
}
