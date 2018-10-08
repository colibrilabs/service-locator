<?php

namespace Subapp\ServiceLocator;

/**
 * Interface ContainerInterface
 * @package Subapp\ServiceLocator
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
   * @param array $parameters
   * @return mixed
   */
  public function get($name, array $parameters = []);
  
  /**
   * @param $name
   * @param array $parameters
   * @return mixed
   */
  public function factory($name, array $parameters = []);
  
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