<?php

namespace App\Http\Services;


class UploadService
{
    public function store($request){
        if($request->hasFile('file')){
            try {
                //lay file
                $file = $request->file('file');
                //lay ten file
                $name = $file->getClientOriginalName();
                //duong dan full
                $pathFull = 'uploads/' . date("Y/m/d");
                //duong dan cua file
                $path = $file->StoreAs(
                    'public/' . $pathFull ,$name
                );
                return '/storage/' . $pathFull . '/' . $name;
            }
            catch (\Exception $error){
                return false;
            }

        }
    }


}

