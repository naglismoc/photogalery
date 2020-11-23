<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
use Auth;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if ($request->has('photos')) {
        $folder = public_path('img');
        $user = Auth::User();
      foreach ($request->file('photos') as $photo) {
        $img = Image::make($photo);
        $fileName = Str::random(5).'.jpg';
        $img->resize(270,null,function ($constraint){
              $constraint->aspectRatio();
        });
        $img->save($folder.'/'.$fileName,100, 'jpg');

        $photo = new Photo();
        $photo->photo = $fileName;
        $photo->user_id =$user->id;
        $photo->save();
      }
      }
      return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Photo $photo)
    {
        //
    }  
    public function deletePhoto( $id)
    {
        $photo = Photo::find($id);
        if(!$photo->photo=="" || $photo->photo!=null){
            unlink(public_path('img\\'.$photo->photo));
        }
        $photo->delete();
        return redirect()->route('user.index');
    }
}
