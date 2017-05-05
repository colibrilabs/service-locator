<?php

    namespace Dez\DependencyInjection;

    /**
     * Interface ServiceInterface
     * @package De\DependencyInjection
     */
    interface ServiceInterface {

        /**
         * @return mixed
         */
        public function getDefinition();

        /**
         * @param $definition
         * @return mixed
         */
        public function setDefinition( $definition );

        /**
         * @return mixed
         */
        public function getName();


        /**
         * @param array $parameters
         * @param ContainerInterface $d
         * @return mixed
         */
        public function resolve( array $parameters = [], ContainerInterface $d );

    }