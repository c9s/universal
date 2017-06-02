<?php

namespace Universal\ClassLoader;

use PHPUnit\Framework\TestCase;
use Exception;

class BasePathClassLoaderTest extends TestCase
{
    function testFunc()
    {
        $loader = new BasePathClassLoader(array(
            'tests/lib'
        ));
        $loader->register();

        spl_autoload_call( 'Foo\Bar' );
        $this->assertTrue(class_exists( 'Foo\Bar'));
        $loader->unregister();
    }
}


