<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;
class PhotosController extends Controller
{
    public function create($album_id)
    {
          return view('photos.create')->with('album_id',$album_id);
    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'title'=>'required',
            'photo'=>'image|max:6000'
        ]);
        //get file name with extention
        $filenamewithExt= $request->file('photo')->getClientOriginalName();
        //geting without extention
        $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
          //get extension
        $extension =$request->file('photo')->getClientOriginalExtension();
        //create new file namw
        $filenametoStore=$filename.'_'.time().'.'.$extension;
        //uploadimage
        $path=$request->file('photo')->storeAs('public/photos/'.$request->input('album_id'),$filenametoStore);
        //upload photo
        $photo=new Photo;
        $photo->album_id=$request->input('album_id');
        $photo->title=$request->input('title');
        $photo->discription=$request->input('discription');
        $photo->photo=$filenametoStore;
        $photo->size=$request->file('photo')->getClientSize();
        $photo->save();
        return redirect('/albums/'.$request->input('album_id'))->with('success','Photo Uploaded');
    }
    public function show($id)
    {
        $photo=Photo::find($id);
        return view('photos.show')->with('photo',$photo);
    }

    public function destroy($id)
    {
        
  $photo=Photo::find($id);
  if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo));
  $photo->delete();
  return redirect('/')->with('success','Photo Was Deleted');
    }
}
