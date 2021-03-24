<?php

namespace LabbeAramis\Modules;

use Illuminate\Events\Dispatcher;
use LabbeAramis\Modules\Contracts\EventInterface;
use LabbeAramis\Modules\Exceptions\MediatorException;

/**
 * Class Mediator
 *
 * @package LabbeAramis\Modules
 */
class Mediator extends Dispatcher
{
    /**
     * Fire an event and call the listeners.
     *
     * @param object|string $event
     * @param array         $payload
     * @param bool          $halt
     *
     * @return MediatorResponse[]|MediatorResponse|null
     * @throws MediatorException
     */
    public function dispatch( $event, $payload = [], $halt = false )
    {

        // When the given "event" is actually an object we will assume it is an event
        // object and use the class as the event name and this event itself as the
        // payload to the handler, which makes object based events quite simple.
        [$event, $payload] = $this->parseEventAndPayload(
            $event, $payload
        );

        if ( $this->shouldBroadcast( $payload ) ) {
            $this->broadcastEvent( $payload[0] );
        }

        $responses       = [];
        $passedListeners = [];

        foreach ($this->getListeners( $event ) as $listener) {

            $response = $this->createResponse( $listener( $event, $payload ) );

            if ( $response instanceof MediatorResponse
                && $response->isSuccess() === false ) {
                break;
            }

            $passedListeners[] = $listener;

            // If a response is returned from the listener and event halting is enabled
            // we will just return this response, and not call the rest of the event
            // listeners. Otherwise we will add the response on the response list.
//            if ( $halt && !is_null( $response->getData() ) ) {
//                return $response;
//            }

            // If a boolean false is returned from a listener, we will stop propagating
            // the event to any further listeners down in the chain, else we keep on
            // looping through the listeners and firing every one in our sequence.
//            if ( $response->getData() === false ) {
//                break;
//            }

            $responses[] = $response;
        }

        if ( count( $responses ) === count( $passedListeners ) ) {
            return $halt ? null : $responses;
        }

        if ( is_array( $payload ) === true
            && isset( $payload[0] ) === true
            && $payload[0] instanceof EventInterface ) {

            $payload[0]->setIsRollback( true );

            foreach ($passedListeners as $listener) {
                $this->createResponse( $listener( $event, $payload ) );
            }
        }

        return null;
    }

    /**
     * @param $response
     *
     * @return MediatorResponse
     * @throws MediatorException
     */
    private function createResponse( $response ): MediatorResponse
    {

        if ( $response instanceof MediatorResponse ) {
            return $response;
        }

        if ( $response !== null
            && is_array( $response ) === true
            && array_key_exists( 'name', $response ) === true
            && is_string( $response['name'] ) === true
            && array_key_exists( 'data', $response ) === true ) {

            return new MediatorResponse( $response['name'], $response['data'] );
        }

        throw MediatorException::invalidResponse();
    }
}
