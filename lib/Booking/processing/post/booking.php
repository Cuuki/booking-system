<?php

use Symfony\Component\HttpFoundation\Response;

include_once BOOKING_DIR . '/../validation.php';
include_once BOOKING_DIR . '/processing/reserve.php';

$postdata = array(
    'firstname' => $firstname->get( 'firstname' ),
    'lastname' => $lastname->get( 'lastname' ),
    'email' => $email->get( 'email' ),
    'plz' => $plz->get( 'plz' ),
    'ort' => $ort->get( 'ort' ),
    'straße' => $straße->get( 'straße' ),
);

$sanitizeBooking = sanitizeBooking( $postdata );
$invalidInput = validate( $sanitizeBooking );

if( !empty( $invalidInput ) )
{
    return new Response( $app['twig']->render( 'booking.twig', array(
        'errormessages' => getErrormessages( $invalidInput ),
        'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.',
        'value' => $postdata
    ) ), 404 );
}

die;
//$reservation = reserve( $postdata, $app );

if ( !$reservation )
{
    return new Response( $app['twig']->render( 'booking.twig', array(
        'message' => 'Ihre Reservierung war leider nicht erfolgreich. Bitte versuchen Sie es erneut.',
        'message_class' => 'alert alert-dismissable alert-danger',
        'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.',
        'value' => $postdata
    ) ), 404 );
}

return new Response( $app['twig']->render( 'booking.twig', array(
    'message' => 'Ihre Reservierung war erfolgreich. Sie erhalten die Rechnung per Mail.',
    'message_class' => 'alert alert-dismissable alert-success',    
    'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.',
    'value' => $postdata
) ), 201 );
