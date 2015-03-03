<?php

namespace Booking;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

define( 'BOOKING_DIR', realpath( __DIR__ . '/../lib/Booking' ) );

class BookingControllerProvider implements ControllerProviderInterface
{
    public function connect ( Application $app )
    {
        // creates a new controller based on the default route
        $controllers = $app['controllers_factory'];

        $controllers->get( '/', function () use ( $app )
        {
            return include_once __DIR__ . '/../templates/index.html';
        } )->bind( 'guestbook' );

        $controllers->post( '/', function ( Request $standort, Request $beginn, Request $ende, Request $gaeste ) use ( $app )
        {
            $postdata = array(
                'firstname' => $standort->get( 'standort' ),
                'lastname' => $beginn->get( 'beginn' ),
                'email' => $ende->get( 'ende' ),
                'textinput' => $gaeste->get( 'gaeste' )
            );
            
            return include_once BOOKING_DIR . '/processing';
        } );

        return $controllers;
    }

}
