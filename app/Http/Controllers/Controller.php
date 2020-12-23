<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function getAllId($object)
    {
        $id = [];
        foreach($object as $array) {
            $id[] = $array['id'];
        }
        return $id;
    }

    public function fileValidation($file, $arr_valid_extension)
    {   
        if(!in_array($file->extension(), $arr_valid_extension)) {
            return true;
        } 
        return false;
    }

    public function uploadFile($filename, $file, $path)
    {
        $extension = $file->extension();
        $filename  = $filename . '.' . $extension;
        Storage::putFileAs('public/'. $path, $file, $filename);

        return $filename;
    }

    public function getAllOneColumn($arr_object, $column_name) {
        $valid_to_return = [];
        foreach ($arr_object as $object) {
            $valid_to_return[] = $object->$column_name;
        }

        return $valid_to_return;
    }
}
