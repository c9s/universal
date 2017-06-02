<?php 
namespace Universal\Session\State;

class NativeState
{

    public function __construct()
    {
        if (! isset($_SESSION) ) {
            @session_start();
            /*
            if (isset($_REQUEST['session_expiry']) ) {
                @setcookie(session_name(),session_id(),time()+ intval($_REQUEST['session_expiry']) );
            }
            */
        }
    }

    public function setCookieParams($seconds)
    {
        session_set_cookie_params($seconds);
    }

    public function getSid()
    {
        return session_id();
    }

    public function generateSid()
    {
        return session_regenerate_id();
    }


}

