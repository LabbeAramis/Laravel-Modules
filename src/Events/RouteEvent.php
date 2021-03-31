<?php

namespace LabbeAramis\Modules\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Illuminate\Routing\Controller;
use LabbeAramis\Modules\Event;
use LabbeAramis\Modules\Traits\Dispatchable;

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
     * @param Controller   $controller
     * @param string       $method
     * @param Request|null $request
     */
    public function __construct(Controller $controller, string $method, Request $request = null)
    {
        $this->controller = $controller;
        $this->method = $method;
        $this->request = $request;
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
}
