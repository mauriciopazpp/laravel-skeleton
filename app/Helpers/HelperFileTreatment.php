<?php namespace App\Helpers;

use App;
use Illuminate\Support\Facades\File;
use Imagine\Image\Box;
use Imagine\Image\ImageInterface;
use Orchestra\Imagine\Facade as Imagine;

class HelperFileTreatment
{
    /**
     * Move the file and return the new name of file
     *
     * @param $file
     * @param $path
     * @return string
     */
    public function moveUploadedFile($data, $path, $name = 'User_')
    {
        $destinationPath = storage_path() . '/' . $path;
        $newName = $name . date('d') .'_'. date('m') .'_'. date('Y') .'_'. str_random(6);
        $newFile = $this->createThumbnail($data->getPath(), 
                                          $destinationPath, 
                                          $data->getFileName(),
                                          $newName, 
                                          $data->getClientOriginalExtension());
        
        return $newFile;
    }

    public function upload($data, $path)
    {
        $destinationPath = storage_path() . '/' . $path;

        if(!is_array($data))
        {
            $fileName = 'File_'. date('d') .'_'. date('m') .'_'. date('Y') .'_'. str_random(12) . "." . $data->getClientOriginalExtension();
            $data->move($destinationPath, $fileName);

            return $fileName;
        }
        $fileNames = [];
        foreach ($data as $file)
            $fileNames[] = $this->moveUploadedFile($file, $path);

        return $fileNames;
    }

    function createThumbnail($dirPath, $destinationPath, $oldName, $newName, $extension)
    {
        $width  = 320;
        $height = 320;

        $mode   = ImageInterface::THUMBNAIL_OUTBOUND;
        $size   = new Box($width, $height);

        $thumbnail   = Imagine::open("{$dirPath}/{$oldName}")->thumbnail($size, $mode);
        $newFile = "{$newName}.thumb.{$extension}";

        $thumbnail->save("{$destinationPath}/{$newFile}");

        return $newFile;
    }

    /**
     * Delete the image from disk
     *
     * @param $file
     * @param $path
     * @return bool
     */
    public function destroy($data, $path)
    {
        $filePath = storage_path() . '/' . $path;

        if(!is_array($data))
        {
            File::delete($filePath . $data);
            return $data;
        }

        $files = [];
        foreach ($data as $file)
            $files[] = $this->destroy($file, $filePath);

        return $files;
    }
}