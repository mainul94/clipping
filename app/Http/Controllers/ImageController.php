<?php

namespace App\Http\Controllers;

use App\Exceptions\NoTask;
use App\Task;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use League\Flysystem\Config;

class ImageController extends Controller
{
    protected $disk;

    public function __construct(Request $request)
    {
        if (empty($request->get('task_id'))){
            $this->disk = 'ftp';
        }else
        {
            $task = Task::where('id', $request->get('task_id'))->first();
            if (!empty($task))  {
                config(['filesystems.disks.ftp'.$task->id => (array) $task->ftp]);
                $this->disk = 'ftp'.$task->id;
            }else{
                $this->disk = 'local';
            }

        }
    }

    /**s
     * Display a listing of the resource.
     *
     * @return array
     */
    public function index(Request $request)
    {
        $dir = $request->get('root','');
        $directories = Storage::disk($this->disk)->directories($dir);
        $files = Storage::disk($this->disk)->files($dir);
        return [
            'directories'=>$directories,
            'files'=>$files
        ];
    }


    public function directory(Request $request)
    {
        if (in_array($request->get('type'), ['New', 'Post'])) {
            $dir = $request->get('root').
                (strrev($request->get('root'))[0] == '/' || $request->get('folder_name') == '/' ? '':'/').
                $request->get('folder_name');
            Storage::disk($this->disk)->makeDirectory($dir);
            return ['type'=>'new', 'directory'=>$dir];
        }
        elseif (strtolower($request->get('type')) === 'delete') {
            Storage::disk($this->disk)->deleteDirectory($request->get('root'));
            return ['type'=>'delete', 'directory'=>$request->get('root')];
        } elseif (in_array($request->get('type'), ['Rename', 'Edit', 'Patch'])) {
            $form_dir = $request->get('root').
                (strrev($request->get('root'))[0] == '/' || $request->get('folder_name') == '/' ? '':'/').
                $request->get('folder_name');
            $to_dir = $request->get('root').
                (strrev($request->get('root'))[0] == '/' || $request->get('new_name') == '/' ? '':'/').
                $request->get('new_name');
            Storage::disk($this->disk)->move($form_dir,$to_dir);
            return ['type'=>'rename', 'from_dir'=>$form_dir, 'to_dir'=>$to_dir];
        }
    }


    public function file(Request $request)
    {
        if (strtolower($request->get('type')) === 'delete') {
            Storage::disk($this->disk)->delete($request->get('root'));
            return ['type'=>'delete', 'file'=>$request->get('root')];
        } elseif (in_array($request->get('type'), ['Rename', 'Edit', 'Patch'])) {
            $form_file = $request->get('root').
                (strrev($request->get('root'))[0] == '/' || $request->get('file_name') == '/' ? '':'/').
                $request->get('file_name');
            $to_file = $request->get('root').
                (strrev($request->get('root'))[0] == '/' || $request->get('new_name') == '/' ? '':'/').
                $request->get('new_name');
            Storage::disk($this->disk)->move($form_file,$to_file);
            return ['type'=>'rename', 'from_file'=>$form_file, 'to_file'=>$to_file];
        }
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
     * @return array
     */
    public function store(Request $request)
    {
	    $paths = [];
	    foreach ($request->file('images') as $file) {
		    $path = $file->storeAs($request->get('root'), $file->getClientOriginalName(), $this->disk);

            $preview = Image::make($file->getRealPath())->resize(600, null, function ($context) {
                $context->aspectRatio();
            })->encode('jpg');


            $pre_dir = $request->get('root') . '/.preview/' ;
            $this->make_directory($pre_dir);
//            dd($preview);
            Storage::disk($this->disk)->put($pre_dir. preg_replace('/\\.[^.\\s]{3,4}$/', '.jpg',
                    $file->getClientOriginalName()),
                $preview);

            $thumbnail = Image::make($file->getRealPath())->resize(150, null, function ($context) {
                $context->aspectRatio();
            })->encode('jpg');

            $thumb_dir = $request->get('root') . '/.thumbnail/';
            $this->make_directory($thumb_dir);

            Storage::disk($this->disk)->put($thumb_dir . preg_replace('/\\.[^.\\s]{3,4}$/', '.jpg',
                    $file->getClientOriginalName()), $thumbnail);

		    array_push($paths, $path);
	    }
	    return $paths;
    }

    /**
     * @param $dir
     */
    public function make_directory($dir)
    {
        if (!Storage::disk($this->disk)->exists($dir)) {
            Storage::disk($this->disk)->makeDirectory($dir);
        }
    }

    public function get_thumbnail($file_url)
    {
        $file = str_replace(basename($file_url), '.thumbnail/'.basename($file_url), $file_url);
        if (Storage::disk($this->disk)->exists($file)) {
            return Storage::disk($this->disk)->get($file);
        }
        return true;
    }

    public function get_preview($file_url)
    {
        $file = str_replace(basename($file_url), '.preview/'.basename($file_url), $file_url);
        if (Storage::disk($this->disk)->exists($file)) {
            return Storage::disk($this->disk)->get($file);
        }
        return true;
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
