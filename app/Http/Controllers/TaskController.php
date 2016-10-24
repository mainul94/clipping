<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TaskController extends Controller
{

    use CommonController;

    /**
     * RoleController constructor.
     */
    public function __construct(Request $request)
    {
        $this->view_dir = 'admin.task.';
        $this->model = new Task();
        $this->permissionCheckSetup($request);
    }


    public function validate_rules(Task $data = null)
    {
        return [
            'title'=>'required',
            'client_id'=>'required',
            'total_qty'=>'required',
            'slug' => 'Unique:tasks'.($data && $data->id?',slug,'.$data->id:'')
        ];

    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function index()
    {
        $tasks = Task::all();
        return view('task.tasks',compact('tasks'));
    }*/

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function create()
    {
        return view('task.create');
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function afterSave(Task $task, Request $request)
    {
        $base_directory = '/public/jobs/'.$task->id;
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Original/thumbnail');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Original/preview');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Done/thumbnail');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Done/preview');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function show($id)
    {
        //
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editWith(Task $id)
    {
        $storage_dik ='local';
        $base_directory = '/jobs/'.$id->id;
        $allfiles = Storage::disk($storage_dik)->files($base_directory.'/Original/');
        $images = Storage::disk($storage_dik)->files($base_directory.'/Original/thumbnail/');
        if (count($allfiles) > count($images)) {
            foreach ($allfiles as $item) {
                if (!in_array(basename($item), $images)) {
                    Storage::disk($storage_dik)->makeDirectory($base_directory.'/Original/thumbnail');
                    $img = Image::make($item);
                    $img->resize(300, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save(storage_path('app'.$base_directory.'/Original/thumbnail/'.basename($item)));
                    array_push($images, $base_directory . '/Original/thumbnail/'.basename($item));
                }
            }
        }

        return ['images'=>$images];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function update(Request $request, Task $id)
    {
        $this->validateRule($request);
        $id->fill($request->all())->save();
        return redirect()->back()->with('message', ['type'=>'success', 'msg'=>'successfully Updated']);
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /*public function destroy(Task $id)
    {
        $id->delete();
        return redirect()->back()->with('message', ['type' => 'successfully Deleted']);
    }*/
}
