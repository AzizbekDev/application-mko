<?php
namespace App\Traits;

trait Logger{

    public function logger($content, $dir)
    {
        $folder_path = $dir.'/'.date('Y-m');
//      unlink(storage_path("logs/".$folder_path."/".date('M-d').'.log'));
        self::dirChecker($folder_path);

        $path = storage_path("logs/".$folder_path."/".date('M-d').'.log');
        $content = array_merge([
            'date' => date('Y-m-d H:i:s')
        ],$content);
        return fwrite(fopen($path,'a'),json_encode($content,JSON_UNESCAPED_UNICODE)."\n");
    }

    public static function dirChecker($dir)
    {
        $directories = explode("/",$dir);

        $dir_path    = storage_path("logs");

        foreach ($directories as $directory) {

            $dir_path .= "/".$directory;

            if(is_dir($dir_path) === false )
            {
                mkdir($dir_path);
            }
        }
    }
}