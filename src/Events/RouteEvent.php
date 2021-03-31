<?php

namespace LabbeAramis\Modules\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\Controller;
use LabbeAramis\Modules\Event;
use LabbeAramis\Modules\Traits\Dispatchable;
use ReflectionParameter;

/**
 * Class RouteEvent
 *
 * @package LabbeAramis\Modules\Events
 */
class RouteEvent extends Event
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var Controller
     */
    private Controller $controller;

    /**
     * @var string
     */
    private string $method;

    /**
     * @var array|Application|Request|null|string
     */
    private ?Request $request;

    /**
     * RouteEvent constructor.
     *
     * @param Controller|string $controller
     * @param string            $method
     * @param Request|null      $request
     *
     * @throws \ReflectionException
     * @throws \Exception
     */
    public function __construct($controller, string $method, Request $request = null)
    {
        $this->method = $method;
        $this->request = $request;

        if ( $controller instanceof Controller ) {

            $this->controller = $controller;
        } elseif ( gettype($controller) === 'string' ) {

            $this->controller = $this->createObject($controller);
        } else {

            throw new \Exception('Can\'t create object');
        }
    }

    /**
     * @return Controller
     */
    public function getController(): Controller
    {
        return $this->controller;
    }

    /**
     * @return string
     */
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * @return array|Application|Request|null|string
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param string $className
     *
     * @return object
     * @throws \ReflectionException
     */
    protected function createObject(string $className)
    {

        if ( class_exists($className, true) === true ) {

            $reflection = new \ReflectionClass($className);

            if ( $reflection->isInstantiable() === true ) {

                $constructor = $reflection->getConstructor();
                $constructorParams = $constructor->getParameters();

                $getDependencies = function(array $params = []) use ($className) {

                    $dependencies = [];

                    /** @var ReflectionParameter $param */
                    foreach ($params as $param) {

                        $class = $param->getDeclaringClass();
                        if ( $class !== null ) {
                            $paramClassName = $class->getName();
                            $dependencies[] = $this->createObject($paramClassName);
                        } elseif ( $param->hasType() === true ) {
                            if ( $param->isDefaultValueAvailable() === true ) {
                                $dependencies[] = $param->getDefaultValue();
                            } elseif ( $param->allowsNull() === true ) {
                                $dependencies[] = null;
                            } else {
                                throw new \Exception('Can\'t create object "' . $className . '"');
                            }
                        } elseif ( $param->allowsNull() === true ) {
                            $dependencies[] = null;
                        } else {
                            throw new \Exception('Can\'t create object "' . $className . '"');
                        }
                    }

                    return $dependencies;
                };

                return $reflection->newInstance(...$getDependencies($constructorParams));
            }
        }
    }
}
