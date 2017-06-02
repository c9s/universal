<?php 

namespace Universal\Session\State;

use RuntimeException;

class CookieState
{

    /**
     * @var array cookie parameter array
     */
    protected $cookieParams;

    /**
     * @var string session key
     */
    protected $sessionKey;


    /**
     * @var string session id string
     */
    protected $sessionId;

    /**
     * @var callable sid generator
     */
    protected $sidGenerator;

    /**
     * @var callable sid validator
     */
    protected $sidValidator;


    /**
     *
     * @param string $sessionKey
     * @param array $extraCookieParams
     */
    public function __construct($sessionKey = 'ses', array $extraCookieParams = null)
    {
        $this->sessionKey = $sessionKey;
        // $this->secret     = isset($options['secret']) ? $options['secret'] : md5(microtime());

        /*
        if (isset($options['sid_generator'])) {
            $this->sidGenerator = $options['sid_generator'];
        }
        if (isset($options['sid_validator'])) {
            $this->sidValidator = $options['sid_validator'];
        }
        */

        /* default cookie param */
        $defaultCookieParams = array(
            'path'     => '/',
            'expire'   => 0,
            'domain'   => null, //
            'secure'   => false, // false,
            'httponly' => false, // false,
        );

        $this->cookieParams = $extraCookieParams 
            ?  array_merge($defaultCookieParams, $extraCookieParams) 
            : $defaultCookieParams;

        $this->sessionId = $this->getSid();

        if (!$this->validateSid($this->sessionId)) {
            throw new Exception( "Invalid Session Id" );
        }

        if (!isset($_SERVER['argv'])) {
            $this->write($this->sessionId);
        }
    }

    public function getSid()
    {
        return isset($_COOKIE[$this->sessionKey]) ? $_COOKIE[$this->sessionKey] : $this->generateSid();
    }

    /**
     * set default cookie params
     */
    public function setCookieParams(array $config)
    {
        $this->cookieParams = array_merge( $this->cookieParams , $config );
    }


    /**
     * let current cookie be expired.
     */
    public function setCookieExpire()
    {
        $this->setSessionCookie(array( 'expire' => time() ));
    }

    public function setSessionCookie(array $config = null)
    {
        if ($config) {
            $this->cookieParams = array_merge($this->cookieParams , $config );
        }

        // bool setcookie ( string $name [, string $value [, int $expire = 0 [, 
        //    string $path [, string $domain [, bool $secure = false [, bool 
        //    $httponly = false ]]]]]] )
        setcookie($this->sessionKey, $this->sessionId, 
            @$this->cookieParams['expire'],
            @$this->cookieParams['path'],
            @$this->cookieParams['domain'],
            @$this->cookieParams['secure'],
            @$this->cookieParams['httponly']
        );
    }


    /**
     * write cookie
     */
    public function write()
    {
        $this->setSessionCookie();
    }


    /**
     * sid generator
     */
    public function generateSid()
    {
        if ($this->sidGenerator) {
            return call_user_func($this->sidGenerator);
        }
        return sha1( rand() . microtime() );
    }

    /**
     * validate sid string
     */
    public function validateSid($sid)
    {
        if ($this->sidValidator) {
            return call_user_func($this->sidValidator, $sid);
        }
        return preg_match( '/\A[0-9a-f]{40}\Z/' , $sid );
    }


    public function setValidator(callable $validator)
    {
        $this->sidValidator = $validator;
    }

    public function setGenerator(callable $generator)
    {
        $this->sidGenerator = $generator;
    }


    /**
     * sign data with sha1 and secret key
     */
    /*
    public function sign($data)
    {
        return hash_hmac('sha1', $data , $this->secret );
        // return hash_hmac('sha256', $data , $this->secret );
    }
    */
}
