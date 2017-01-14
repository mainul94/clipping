<?php
/**
 * Created by PhpStorm.
 * User: mainul
 * Date: 8/21/16
 * Time: 10:02 PM
 */

namespace App;


use Carbon\Carbon;
use Intervention\Image\Facades\Image;

trait UploadFiles
{
    /**
     * @param $data
     * @param $attributeName
     */
    public function fileUploadOnlyRowAndSetAttribute($data, $attributeName='', $storageDir=null, $repDir=null, $need_preview = true)
    {
        if ($data->isValid()) {
            if (is_null($storageDir)) {
                $storageDir = 'app/public/quotations/';
            }
            if (is_null($repDir)) {
                $repDir = 'app/public';
            }
            $dir = storage_path($storageDir);
            $fileName = Carbon::now()->timestamp.$data->getClientOriginalName();
            $data->move($dir,$fileName);
            $this->attributes[$attributeName] = str_replace(storage_path($repDir), '',$dir.$fileName);
        }
    }


    /**
     * @param $data
     * @param $attributeName
     */
    public function fileUploadAndSetAttribute($data, $attributeName='', $storageDir=null, $repDir=null, $need_preview = true)
    {
        if ($data->isValid()) {
            if (is_null($storageDir)) {
                $storageDir = 'app/public/quotation/';
            }
            if (is_null($repDir)) {
                $repDir = 'app/public';
            }
            $dir = storage_path($storageDir);
            $fileName = Carbon::now()->timestamp.$data->getClientOriginalName();
            $data->move($dir,$fileName);
            if ($need_preview) {
                $preview_path = $dir.'preview/'.$fileName;
                Image::make($data->getRealPath())->resize(700,null, function ($context) {
                    $context->aspectRatio();
                })->save($preview_path);
                $this->attributes[$attributeName.'_preview'] = str_replace(storage_path($repDir), '',$preview_path);
            }
            $thumbnail_path = $dir.'thumbnail/'.$fileName;
            Image::make($data->getRealPath())->resize(300,null, function ($context) {
                $context->aspectRatio();
            })->save($thumbnail_path);
            $this->attributes[$attributeName.'_thumbnail'] = str_replace(storage_path($repDir), '', $thumbnail_path);
            $this->attributes[$attributeName] = str_replace(storage_path($repDir), '',$dir.$fileName);
        }
    }
}