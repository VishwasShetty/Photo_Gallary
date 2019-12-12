<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Album;
use App\Photo;
class AlbumsController extends Controller
{
    public function index()
    {
        $albums=Album::with('Photos')->get();
        return view('albums.index')->with('albums',$albums);
    }
    public function create()
    {
        return  view('albums.create');
    }

    public function store(Request $request)
    {
         $this->validate($request,[
            'name'=>'required',
            'cover_image'=>'image|max:6000'
        ]);
        //get file name with extention
        $filenamewithExt= $request->file('cover_image')->getClientOriginalName();
        //geting without extention
        $filename=pathinfo($filenamewithExt,PATHINFO_FILENAME);
          //get extension
        $extension =$request->file('cover_image')->getClientOriginalExtension();
        //create new file namw
        $filenametoStore=$filename.'_'.time().'.'.$extension;
        //uploadimage
        $path=$request->file('cover_image')->storeAs('public/album_covers',$filenametoStore);
        //create album
        $album=new Album;
        $album->name=$request->input('name');
        $album->discription=$request->input('discription');
        $album->cover_image=$filenametoStore;
        $album->save();
        return redirect('/albums')->with('success','Albums created');
    }
    public function show($id)
    {
        $album=Album::with('Photos')->find($id);
        return view('albums.show')->with('album',$album);   
     }
     public function destroy($id)
     {
         //finding the album in table;
        $album=Album::find($id);
        //finding the photos related to that model
        $photos=DB::table('photos')->where('album_id',$id)->get();
        //fetching each photos to the variable photo
        foreach($photos as $photo)
        {
            //finding the photo in photo model
            $p=Photo::find($photo->id);
            //deleting photo from the storage as well as form the database 
            if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo));
            $p->delete();
        }
        //deleting the album
        if(Storage::delete('public/photos/'.$album->album_id.'/'.$album->cover_image));
        $album->delete();
        return redirect('/')->with('success','Album Deleted Sucessfully');    
     }
}
