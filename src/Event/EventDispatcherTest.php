<?php
/**
 * This file is part of the Universal package.
 *
 * (c) Yo-An Lin <yoanlin93@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 */
namespace Universal\Event;

use PHPUnit\Framework\TestCase;

class EventDispatcherTest extends \PHPUnit\Framework\TestCase 
{
    public function testBasicUsage()
    {
        global $z;
        $e = EventDispatcher::getInstance();
        $e->register( 'test', function($a,$b,$c) {
            global $z;
            $z = $a + $b + $c;
        });
        $e->trigger( 'test' , 1,2,3  );
        $this->assertEquals( 6, $z );
    }
}

