<?php

namespace Universal\ClassLoader;

class MapClassLoaderTest extends \PHPUnit\Framework\TestCase
{
    public function testMapClassLoader()
    {
        $loader = new MapClassLoader(array(
            'MyBar\Foo' => 'tests/fixtures/class_loader/psr4/simple/Foo.php',
        ));
        $classPath = $loader->resolveClass('MyBar\Foo');
        $this->assertNotNull($classPath);
        $this->assertFileExists($classPath);
    }
}

