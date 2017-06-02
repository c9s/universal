<?php

class SplClassLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testAddPrefix()
    {
        $loader = new \Universal\ClassLoader\SplClassLoader(array(
            'CLIFramework' => 'vendor/corneltek/cliframework',
        ));
        $loader->addPrefix('CLIFramework\\', 'src/');
    }

    public function testAddNamespace()
    {
        $loader = new \Universal\ClassLoader\SplClassLoader;
        $loader->addNamespace('Foo', 'tests' . DIRECTORY_SEPARATOR . 'lib');
        $loader->register();
        $foo = new \Foo\Foo;
        $bar = new \Foo\Bar;
        $loader->unregister();
    }

    public function testReloadGuard()
    {
        require 'src/ClassLoader/SplClassLoader.php';
        require 'src/ClassLoader/SplClassLoader.php';
    }
}

