<?php

namespace Colibri\ServiceLocator;

/**
 * Class Container
 * @package Colibri\ServiceLocator
 */
class Container implements ContainerInterface
{
  
  /**
   * @var static
   */
  static protected $container;
  /**
   * @var array
   */
  protected $services = [];
  /**
   * @var array
   */
  protected $instances = [];
  
  /**
   * Constructor
   */
  public function __construct()
  {
    if (!static::getContainer()) {
      static::setContainer($this);
    }
  }
  
  /**
   * @return mixed
   */
  public function getContainer()
  {
    return self::$container;
  }
  
  /**
   * @param mixed $container
   * @return void
   */
  public function setContainer(ContainerInterface $container)
  {
    self::$container = $container;
  }
  
  /**
   * @return static
   */
  static public function instance()
  {
    if (!static::$container || !(static::$container instanceof static)) {
      static::$container = new static();
    }
    
    return static::$container;
  }
  
  /**
   * @return int
   */
  public function count()
  {
    return count($this->services);
  }
  
  /**
   * @param mixed $index
   * @return bool
   */
  public function offsetExists($index)
  {
    return $this->has($index);
  }
  
  /**
   * @param $name
   * @return bool
   */
  public function has($name)
  {
    return isset($this->services[$name]);
  }
  
  /**
   * @param mixed $index
   * @return bool
   */
  public function offsetUnset($index)
  {
    return false;
  }
  
  /**
   * @param mixed $index
   * @return mixed
   */
  public function offsetGet($index)
  {
    return $this->get($index);
  }
  
  /**
   * @param $name
   * @param array $parameters
   * @return mixed
   */
  public function get($name, array $parameters = [])
  {
    if (!isset($this->instances[$name])) {
      $this->instances[$name] = $this->factory($name, $parameters);
    }
    
    return $this->instances[$name];
  }
  
  /**
   * @param $name
   * @param array $parameters
   * @return mixed|null|object
   * @throws ServiceLocatorException
   */
  public function factory($name, array $parameters = [])
  {
    $service = $this->getService($name);
    $instance = $service->resolve($parameters);
    
    return $instance;
  }
  
  /**
   * @param $name
   * @return Service $service
   * @throws ServiceLocatorException
   */
  public function getService($name)
  {
    if (!$this->has($name))
      throw new ServiceLocatorException("Service not registered '{$name}'");
    
    return $this->services[$name];
  }
  
  /**
   * @param mixed $name
   * @param mixed $definition
   * @return $this|void
   */
  public function offsetSet($name, $definition)
  {
    $this->set($name, $definition);
  }
  
  /**
   * @param $name
   * @param $definition
   * @return Service
   */
  public function set($name, $definition)
  {
    if (isset($this->instances[$name])) {
      unset($this->instances[$name]);
    }
    
    $service = new Service($name, $definition);
    $this->services[$name] = $service;
    
    return $service;
  }
  
  /**
   * @return \ArrayIterator
   */
  public function getIterator()
  {
    return new \ArrayIterator($this->services);
  }
  
  
}
