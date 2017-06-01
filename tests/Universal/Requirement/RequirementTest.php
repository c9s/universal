<?php 




namespace Universal\Requirement;
use PHPUnit\Framework\TestCase;
use Exception;

class RequirementTest extends \PHPUnit\Framework\TestCase
{
    function testFunc()
    {
        $require = new Requirement;
        ok( $require );
        $require->classes( 'Universal\Requirement\RequirementTest' );

        # ok( $require->extensions('apc') );
        ok( $require->extensions('curl') );

        ok( $require->php( '5.0.0' ) );
        ok( $require->php( '5.0' ) );
    }
}

