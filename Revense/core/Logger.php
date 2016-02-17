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
                mkdir($directoryName, 0777, true);
                
            $file = fopen($fileName, 'a');
            $fileContent = date("Y-m-d h:i:sa") . "\t" . $message . "\n";
            fwrite($file, $fileContent);
            fclose($file);
        }
        catch(Exception $ex)
        {
            
        }
    }
    
    public static function error($error)
    {
        try
        {
            $fileName = 'log/error/' . date('Y') . '/' . date('m') . '/' 
                        . date('d') . date('m') . date('Y') . '.txt';
            $directoryName = dirname($fileName);
            
            if(!is_dir($directoryName))
                mkdir($directoryName, 0777, true);
                
            $file = fopen($fileName, 'a');
            $fileContent = date("Y-m-d h:i:sa") . "\t";
            
            if($error instanceof Exception)
                $fileContent .= $error->getMessage() 
                    . "\t" . $error->getFile() . " (LINE: " . $error->getLine() . ")" . "\n";
            else
                $fileContent .= $error . "\n";
                
            fwrite($file, $fileContent);
            fclose($file);
        }
        catch(Exception $ex)
        {
            
        }
    }
}

?>