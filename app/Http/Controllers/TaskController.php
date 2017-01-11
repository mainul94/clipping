<?php

namespace App\Http\Controllers;

use App\Notifications\CreatedTask;
use App\Notifications\TaskUpdate;
use App\Task;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Notification;
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
        $this->permissionCheckSetup($request,['getFTPDetails']);
    }


    public function validate_rules(Task $data = null)
    {
        $rules =  [
            'title'=>'required',
            'total_qty'=>'required',
            'total_amount'=>'max:8',
            'slug' => 'Unique:tasks'.($data && $data->id?',slug,'.$data->id:'')
        ];

        if (request()->user()->type != 'Client') {
            $rules['client_id'] = 'required';
        }

        return $rules;

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function afterSave(Task $task, Request $request)
    {
        $base_directory = '/public/jobs/'.$task->id;
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Original/thumbnail');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Original/preview');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Done/thumbnail');
        Storage::disk($task->storage)->makeDirectory($base_directory.'/Done/preview');
        $this->sendTheNotificaion($request, $task);
    }

    /*public function showWith(Task $task)
    {
        return $this->editWith($task);
    }*/

    /**
     * Show the form for editing the specified resource.
     *
     * @param Task|object $id
     * @return Response
     */
    /*public function editWith(Task $id)
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
    }*/

    /**
     * Update the specified resource in storage.
     *
     * @param Task $task
     * @param  \Illuminate\Http\Request $request
     * @return Response
     */
    public function afterUpdate(Task $task, Request $request)
    {
        $this->sendTheNotificaion($request, $task);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    /*public function destroy(Task $id)
    {
        $id->delete();
        return redirect()->back()->with('message', ['type' => 'successfully Deleted']);
    }*/


    /**
     * @param Request $request
     * @param Task $task
     */
    public function sendTheNotificaion(Request $request, Task $task)
    {
        $users = User::where('status', '1')->whereIn('type',['Admin', 'Support'])
            ->orWhere('id',$request->get('client_id'))->get();
        Notification::send($users, new TaskUpdate($task));
    }


    /**
     * @param Request $request
     * @param Task $task
     * @return mixed
     */
    public function getFTPDetails(Request $request, Task $task)
    {
        return response()->json((array) $task->ftp);
    }
}
