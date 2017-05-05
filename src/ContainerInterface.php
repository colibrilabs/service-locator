<?php

namespace Colibri\ServiceLocator;

/**
 * @package Colibri\ServiceLocator
 */
interface ContainerInterface extends \ArrayAccess, \IteratorAggregate, \Countable
{
  
  /**
   * @param $name
   * @param $definition
   * @return $this
   */
  public function set($name, $definition);
  
  /**
   * @param $name
   * @return mixed
   */
  public function get($name);
  
  /**
   * @param $name
   * @return boolean
   */
  public function has($name);
  
  /**
   * @param $name
   * @return Service $service
   */
  public function getService($name);
  
}