<?php
namespace App\Helpers;

class ImageUpload{
    public static function handleFileUpload($request, $fieldName, $object, $property)
    {
        if ($request->hasFile($fieldName)) {
            $image = $request->file($fieldName);
            $originalName = $image->getClientOriginalName();
            $extension = $image->getClientOriginalExtension();
            $uniqueFilename = md5(uniqid() . $originalName) . '.' . $extension;
            
            // Move the file to the destination
            $image->move(public_path('Backend/images/shop'), $uniqueFilename);

            // Save the unique filename to the object
            $object->$property = $uniqueFilename;
        } else {
            $object->$property = '';
        }
    }
}



?>
