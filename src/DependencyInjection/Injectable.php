<?php

    namespace Dez\DependencyInjection;

    /**
     * Class Injectable
     * @package Dez\DependencyInjection
     */
    abstract class Injectable implements InjectableInterface {

        /**
         * @var ContainerInterface
         */
        protected $dependencyInjector;

        /**
         * @param ContainerInterface $dependencyInjector
         * @return $this
         */
        public function setDi( ContainerInterface $dependencyInjector ) {
            $this->dependencyInjector   = $dependencyInjector;
            return $this;
        }

        /**
         * @return ContainerInterface
         */
        public function getDi() {
            return $this->dependencyInjector;
        }


        /**
         * @param $property
         * @return mixed|null
         * @throws Exception
         */
        public function __get( $property ) {
            if( ! is_object( $this->dependencyInjector ) || ! ( $this->dependencyInjector instanceOf ContainerInterface ) ) {
                throw new Exception( 'A dependency injection object is required' );
            }

            if( $this->dependencyInjector->has( $property ) ) {
                $service                = $this->dependencyInjector->get( $property );
                $this->{ $property }    = $service;
                return $service;
            }

            return null;
        }

    }