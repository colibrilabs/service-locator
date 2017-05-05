<?php

    namespace Dez\DependencyInjection;

    /**
     * Class DependencyInjection
     * @package Dez
     */
    class Container implements ContainerInterface {

        /**
         * @var array
         */
        protected $services     = [];

        /**
         * @var array
         */
        protected $instances    = [];

        /**
         * @var static
         */
        static protected $di;

        /**
         * Constructor
         */
        public function __construct() {
            if( ! static::getDi() ) {
                static::setDi( $this );
            }
        }

        /**
         * @return static
         */
        static public function instance() {
            if( ! static::$di || ! ( static::$di instanceof static ) ) {
                static::setDi( new static() );
            }
            return static::$di;
        }

        /**
         * @return mixed
         */
        public static function getDi() {
            return self::$di;
        }

        /**
         * @param mixed $di
         * @return static
         */
        public static function setDi( $di )  {
            self::$di = $di;
        }

        /**
         * @param $name
         * @param $definition
         * @return Service
         */
        public function set( $name, $definition ) {

            $service                = new Service( $name, $definition );
            $this->services[$name]  = $service;

            return $service;
        }

        /**
         * @param $name
         * @param array $parameters
         * @return mixed
         */
        public function get( $name, array $parameters = [] ) {

            if( ! isset( $this->instances[$name] ) ) {
                $this->instances[$name] = $this->getNew( $name, $parameters );
            }

            return $this->instances[$name];

        }

        /**
         * @param $name
         * @param array $parameters
         * @return mixed|null|object
         * @throws Exception
         */
        public function getNew( $name, array $parameters = [] ) {

            $service    = $this->getService( $name );
            $instance   = $service->resolve( $parameters, $this );

            return $instance;
        }

        /**
         * @param $name
         * @return Service $service
         * @throws Exception
         */
        public function getService( $name ) {

            if( ! $this->has( $name ) )
                throw new Exception( "Service not registered '{$name}'" );

            return $this->services[$name];
        }

        /**
         * @param $name
         * @return bool
         */
        public function has( $name ) {
            return isset( $this->services[$name] );
        }

        /**
         * @return int
         */
        public function count() {
            return count( $this->services );
        }

        /**
         * @param mixed $index
         * @return bool
         */
        public function offsetExists( $index ) {
            return $this->has( $index );
        }

        /**
         * @param mixed $index
         * @return bool
         */
        public function offsetUnset( $index ) {
            return false;
        }

        /**
         * @param mixed $index
         * @return mixed
         */
        public function offsetGet( $index ) {
            return $this->get( $index );
        }

        /**
         * @param mixed $name
         * @param mixed $definition
         * @return $this|void
         */
        public function offsetSet( $name, $definition ) {
            return $this->set( $name, $definition );
        }

        /**
         * @return \ArrayIterator
         */
        public function getIterator() {
            return new \ArrayIterator( $this->services );
        }


    }