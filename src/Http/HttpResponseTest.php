<?php

class HttpResponseTest extends \PHPUnit\Framework\TestCase
{
    function test()
    {
        $response = new \Universal\Http\HttpResponse(200);
        $response->noCache();
        $response->body('Hello World');
        $body = $response->finalize();
        $this->assertEquals( 'Hello World', $body );
    }
}

