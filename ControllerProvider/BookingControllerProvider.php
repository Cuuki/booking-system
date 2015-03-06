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
            return include_once BOOKING_DIR . '/processing/get/home.php';
        } )->bind( 'home' );

        $controllers->post( '/', function ( Request $region, Request $ort, Request $beginn, Request $ende, Request $gaeste ) use ( $app )
        {   
            return include_once BOOKING_DIR . '/processing/post/home.php';
        } );
        
        $controllers->get( '/booking', function () use ( $app )
        {
            return include_once BOOKING_DIR . '/processing/get/booking.php';
        } )->bind( 'booking' );

        $controllers->post( '/booking', function ( Request $firstname, Request $lastname, Request $email, Request $plz, Request $ort, Request $straße ) use ( $app )
        {   
            return include_once BOOKING_DIR . '/processing/post/booking.php';
        } );  

        return $controllers;
    }

}
