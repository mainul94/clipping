<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/25/16
 * Time: 11:14 AM
 */

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;


trait CommonController
{
    protected $view_dir = null;
    protected $model;
    protected $permission = [
        'index'=>'view',
        'show'=>'view',
        'create'=>'create',
        'store'=>'create',
        'edit'=>'update',
        'update'=>'update',
        'destroy'=>'delete'
    ];
    protected $checkPermission;
    protected function validate_rules() {
        return [];
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($this->checkPermission && !$request->user()->can($this->checkPermission)) {
            return abort(403);
        }

        $rows = $this->model->paginate();
        return view($this->view_dir.'list_view',compact('rows'))->with('withData',[]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($this->checkPermission && !$request->user()->can($this->checkPermission)) {
            return abort(403);
        }
        $with = null;
        if (method_exists(__CLASS__, 'createWith')) {
            $with = $this->createWith();
        }
        return view($this->view_dir.'create')->with('withData',$with);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = $this->model;
        $this->validate($request,$this->validate_rules($model));
        if (!property_exists(__CLASS__, 'model') || empty($model)) {
            return redirect()->back()->with('message', ['type'=>'danger','msg'=>'method "model" doesn\'t exist for class"' . __CLASS__ .'"']);
        }

        if (method_exists(__CLASS__, 'beforeSave')) {
            $this->beforeSave($model, $request);
        }

        $model->fill($request->all())->save();

        if (method_exists(__CLASS__, 'afterSave')) {
            $this->afterSave($model, $request);
        }

        if (method_exists(__CLASS__, 'redirectAfterCreate')) {
            return $this->redirectAfterCreate();
        }

        return redirect()->action(class_basename(__CLASS__) . '@index')->with('message', ['type' => 'success', 'msg' => 'Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $with = null;
        if (method_exists(__CLASS__, 'showWith')) {
            $with = $this->showWith($id);
        }
        return view($this->view_dir.'show', compact('id'))->with('withData', $with);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $with = null;
        if (method_exists(__CLASS__, 'editWith')) {
            $with = $this->editWith($id);
        }
        return view($this->view_dir.'edit', compact('id'))->with('withData', $with);
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
        $this->validate($request,$this->validate_rules($id));

        if (method_exists(__CLASS__, 'beforeUpdate')) {
            $this->beforeUpdate($id, $request);
        }

        $id->fill($request->all())->save();

        if (method_exists(__CLASS__, 'afterUpdate')) {
            $this->afterUpdate($id, $request);
        }

        if (method_exists(__CLASS__, 'redirectAfterUpdate')) {
            return $this->redirectAfterUpdate($id);
        }

        return redirect()->back()->with('message', ['type' => 'success', 'msg' => 'Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (method_exists(__CLASS__, 'beforeDelete')) {
            $this->beforeDelete($id);
        }
        $id->forceDelete();

        if (method_exists(__CLASS__, 'afterDelete')) {
            $this->afterDelete();
        }

        if (method_exists(__CLASS__, 'redirectAfterCreate')) {
            return $this->redirectAfterDelete();
        }

        return redirect()->action(class_basename(__CLASS__ . '@index'))->with('message', ['type' => 'danger', 'msg' => 'Record Deleted']);

    }
}