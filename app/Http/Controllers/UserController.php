<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PhotoController;
use Intervention\Image\ImageManagerStatic as Image;
use Str;
use Auth;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return view('user.index');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
        return view('user.edit',['user'=>User::find($id)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $img = Image::make($request->file("logo"));
      $fileName = Str::random(5).'.jpg';
      $folder = public_path('img');
      $img->resize(200,null,function ($constraint){
            $constraint->aspectRatio();
      });
      $img->save($folder.'/'.$fileName,100, 'jpg');
      $user = User::find($id);
        if(!$user->logo=="" || $user->logo!=null){
            unlink(public_path('img\\'.$user->logo));
        }
      $user->logo = $fileName;
      $user->update();
      return redirect()->route('user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function deletePhoto()
    {
        $user = Auth::user();
            unlink(public_path('img\\'.$user->logo));
      $user->logo = '';
      $user->update();
      return redirect()->route('user.index');
    }
}
