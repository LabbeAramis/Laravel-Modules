<?php

namespace LabbeAramis\Modules\Facades;

use Closure;
use Illuminate\Support\Facades\Event as EventFacade;
use LabbeAramis\Modules\Mediator;

/**
 * @method static Closure createClassListener( string $listener, bool $wildcard = false )
 * @method static Closure makeListener( Closure|string $listener, bool $wildcard = false )
 * @method static Mediator setQueueResolver( callable $resolver )
 * @method static array getListeners( string $eventName )
 * @method static array|null dispatch( string|object $event, mixed $payload = [], bool $halt = false )
 * @method static array|null until( string|object $event, mixed $payload = [] )
 * @method static bool hasListeners( string $eventName )
 * @method static void assertDispatched( string|Closure $event, callable|int $callback = null )
 * @method static void assertDispatchedTimes( string $event, int $times = 1 )
 * @method static void assertNotDispatched( string|Closure $event, callable|int $callback = null )
 * @method static void flush( string $event )
 * @method static void forget( string $event )
 * @method static void forgetPushed()
 * @method static void listen( string|array $events, Closure|string $listener = null )
 * @method static void push( string $event, array $payload = [] )
 * @method static void subscribe( object|string $subscriber )
 *
 * @see \LabbeAramis\Modules\Mediator
 */
class Event extends EventFacade
{

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {

        return 'mediator';
    }
}
