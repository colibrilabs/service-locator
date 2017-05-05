<?php

    namespace Dez\DependencyInjection;

    /**
     * Interface InjectableInterface
     * @package Dez\DependencyInjection
     */
    interface InjectableInterface {

        /**
         * @param ContainerInterface $dependencyInjector
         * @return boolean
         */
        public function setDi( ContainerInterface $dependencyInjector );

        /**
         * @return DiInterface
         */
        public function getDi();

    }