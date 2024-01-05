<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UploadController extends Controller
{
	
    /**
     * Generate Image upload View
     *
     * @return void
     */
    public function dropzone()
    {
    	
    return view('dropzone-view');
    }

    /**
     * Image Upload Code
     *
     * @return void
     */
    public function dropzoneStore(Request $request)
    {
        $image = $request->file('file');
        $imageName = time().$image->getClientOriginalName();
        $image->move(public_path('images'),$imageName);
        $inserts = \DB::insert('insert into users (active, password ) values (?, ?)', [1, $imageName ]);
        return response()->json(['success'=>$imageName]);
    }

    //
}
