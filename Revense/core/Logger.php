<?php

class Logger
{
    public static function info($message)
    {
        try
        {
            $fileName = 'log/info/' . date('Y') . '/' . date('m') . '/' 
                        . date('d') . date('m') . date('Y') . '.txt';
            $directoryName = dirname($fileName);
            
            if(!is_dir($directoryName))
                mkdir($directoryName, 0755, true);
                
            $file = fopen($fileName, 'a');
            $fileContent = date("Y-m-d h:i:sa") . "\t" . $message . "\n";
            fwrite($file, $fileContent);
            fclose($file);
        }
        catch(Exception $ex)
        {
            
        }
    }
    
    public static function error($exception)
    {
        try
        {
            $fileName = 'log/error/' . date('Y') . '/' . date('m') . '/' 
                        . date('d') . date('m') . date('Y') . '.txt';
            $directoryName = dirname($fileName);
            
            if(!is_dir($directoryName))
                mkdir($directoryName, 0755, true);
                
            $file = fopen($fileName, 'a');
            $fileContent = date("Y-m-d h:i:sa") . "\t" . $exception->getMessage() 
                    . "\t" . $exception->getFile() . " (LINE: " . $exception->getLine() . ")" . "\n";
            fwrite($file, $fileContent);
            fclose($file);
        }
        catch(Exception $ex)
        {
            
        }
    }
}

?>