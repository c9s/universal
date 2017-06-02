<?php

namespace Universal\ClassLoader;

class Psr0ClassLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testPsr0ClassLoader()
    {
        $loader = new Psr0ClassLoader;
        $loader->addNamespace('Psr0Tests', 'tests/fixtures/psr0');
        $classPath = $loader->resolveClass('Psr0Tests\\Foo');
        $this->assertNotNull($classPath);
        $this->assertFileExists($classPath);
    }
}

