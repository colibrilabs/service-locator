<?php

error_reporting( E_ALL | E_STRICT );
ini_set( 'display_errors', 'On' );

header( 'content-type: text/plain' );

include_once '../vendor/autoload.php';

class TestClass2 {

    public function __construct( ) {
        $params     = func_get_args();
        if( count( $params ) > 0 ) {
            foreach( $params as $name => $value ) {
                $this->{$name}  = $value;
            }
        }
    }

}

class TestClass implements Dez\DependencyInjection\InjectableInterface {

    public function __construct( ) {
        $params     = func_get_args();
        if( count( $params ) > 0 ) {
            foreach( $params as $name => $value ) {
                $this->{$name}  = $value;
            }
        }
    }

    protected $di;

    public function setDi( Dez\DependencyInjection\ContainerInterface $dependencyInjector ) {
        $this->di   = $dependencyInjector;
        return $this;
    }

    public function getDi() {
        return $this->di;
    }

}

$di = new Dez\DependencyInjection\Container();

$di->set( 'test', function( $param1, $param2 ) {
    return new TestClass($param1, $param2);
} );

$di->set( 'test2', '\TestClass2' );

// dump result
die(print_r( [

    $di->get( 'test', [
        'param1'    => '123qwe',
        'param2'    => '321312'
    ] ),

    $di->get( 'test2', [
        'param1'    => '123qwe',
        'param2'    => '321312'
    ] ),

    $di

], true ));
