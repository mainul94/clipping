<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
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
//        return $request->all();
        $task = Task::find($request->get('task'));
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $dir = 'jobs/'.$task->id.'/'.$request->get('type').'/';
            $file = Storage::disk($task->storage)->put(
                $dir.$request->file('image')->getClientOriginalName(),
                file_get_contents($request->file('image')->getRealPath())
            );
            Storage::disk($task->storage)->makeDirectory($dir.'thumbnail/');
            Storage::disk($task->storage)->makeDirectory($dir.'preview/');
            $img = Image::make($request->file('image')->getRealPath());
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/'.$dir.'thumbnail/'.$request->file('image')->getClientOriginalName()));
            $img1= Image::make($request->file('image')->getRealPath());
            $img1->resize(700, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path('app/'.$dir.'preview/'.$request->file('image')->getClientOriginalName()));
        }
        return $request->all();
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
        //
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
        //
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
}
