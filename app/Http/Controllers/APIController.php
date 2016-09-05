<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;

class APIController extends Controller
{

    /**
     * Get value from Api
     * @param Request $request
     */

    public function getValue(Request $request)
    {
        if (!$request->ajax()) {
            return true;
        }
        $data = DB::table($request->get('table'))->select($request->get('select'));

        $filters = $request->get('filters');
        if (!empty($request->get('search'))) {
            if (!$filters) {
                $filters =[[$request->get('search_key'),'like','%'.$request->get('search').'%']];
            }else{
                array_push($filters,[$request->get('search_key'),'like','%'.$request->get('search').'%']);
                return response()->json($filters);

            }

        }
        if (!empty($filters)) {
            $data->where($filters);
        }
        return response()->json($data->get());
    }


    /**
     * @param Request $request
     * $request->get('field') as String or Array
     * $request->get('filters') as Array Ex. ['votes', '=', 100]
     * @param $table
     * @return bool|\Illuminate\Http\JsonResponse
     */
    public function getValues(Request $request)
    {
        if (!$request->ajax()) {
            return true;
        }

        $data = DB::table($request->get('table'));
        if ($request->get('field')) {
            $data->select($request->get('field'));
        }

        if ($request->get('filters')) {
            $data->where($request->get('filters'));
        }
        return response()->json($data->get());
    }
}
