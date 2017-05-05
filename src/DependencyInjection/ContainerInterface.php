<?php

    namespace Dez\DependencyInjection;

    /**
     * Interface DiInterface
     * @package Dez\DependencyInjection
     */
    interface ContainerInterface extends \ArrayAccess, \IteratorAggregate, \Countable {

        /**
         * @param $name
         * @param $definition
         * @return $this
         */
        public function set( $name, $definition );

        /**
         * @param $name
         * @return mixed
         */
        public function get( $name );

        /**
         * @param $name
         * @return boolean
         */
        public function has( $name );

        /**
         * @return Service $service
         */
        public function getService( $name );

    }