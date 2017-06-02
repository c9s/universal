<?php

namespace Universal\Container;


/*
 * This file is part of the {{ }} package.
 *
 * (c) Yo-An Lin <cornelius.howl@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */

class FooObjectBuilder
{
    public $i = 1;

    public function __invoke()
    {
        return 'foo' . $this->i++;
    }
}

use Universal\Container\ObjectContainer;

class ObjectContainerTest extends \PHPUnit\Framework\TestCase 
{
    public function testSingletonBuilder() 
    {
        $container = new ObjectContainer;
        $container->std = function() { 
            return new \stdClass;
        };
        $this->assertInstanceOf('stdClass', $container->std);
        $this->assertSame( $container->std , $container->std );
    }

    public function testFactoryBuilder()
    {
        $container = new ObjectContainer;
        $container->registerFactory('std',function($args) { 
            return $args;
        });
        $a = $container->getObject('std',[1]);
        $this->assertEquals(1,$a);

        $b = $container->getObject('std',[2]);
        $this->assertEquals(2,$b);
    }

    public function testCallableObject()
    {
        $container = new ObjectContainer;
        $container->registerFactory('foo', new FooObjectBuilder);
        $foo = $container->getObject('foo');
        $this->assertEquals('foo1',$foo);
        $this->assertEquals('foo2',$container->foo);
        $this->assertEquals('foo3',$container->foo);
    }
}

