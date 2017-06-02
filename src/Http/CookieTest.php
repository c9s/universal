<?php

class CookieTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $cookie = new Universal\Http\Cookie;
        $cookie->set('test','test');
    }
}

