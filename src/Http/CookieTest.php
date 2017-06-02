<?php

namespace Universal\Http;

class CookieTest extends \PHPUnit\Framework\TestCase
{
    public function testSet()
    {
        $cookie = new Cookie;
        $cookie->set('test','test');
        // $this->assertEquals('test', $cookie->get('test'));
    }
}

