<?php
namespace Http;

// Mail::to()->subject()->line()->send();
// Mail::to()->subject()->view()->send();
class Mail
{
    private static $to;
    private static $subject = "Hi.";
    private static $message;
    private static $headers;
    
    
    public static function to($email)
    {
        static::$to = $email;
        return new static;
    }

    public static function subject($subject)
    {
        static::$subject = $subject;
        return new static;
    }


    public static function line($msg)
    {
        static::$message .= "{$msg} \n ";
        return new static;
    }

    public static function view($file)
    {
        static::$message = require "template/emails/{$file}.view.php";
        return new static;
    }

    public static function headers($headers)
    {
        static::$headers = $headers;
        return new static;
    }

    public static function attach($file)
    {
        // implement file attachment
    }
    
    public static function send()
    {
        static::$to = implode(",", static::$to);
        mail(static::$to, static::$subject, static::$message, static::$headers);
        
        // success redirect
    }
}
