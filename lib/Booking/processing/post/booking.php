<?php

use Symfony\Component\HttpFoundation\Response;

include_once BOOKING_DIR . '/processing/reservation.php';

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

$getCustomer = getCustomer( $postdata, $app );
$getContract = getContract( $getCustomer, $app );

//Prüfen ob Kunde schon existiert, wenn ja dann nur Reservieren, nicht Kunden speichern
if( $getCustomer != false )
{   
    //prüfen ob schon gebucht hat. wenn ja dann kunde sagen er hat das schon gebucht
    if( $getContract != false )
    {
        return new Response( $app['twig']->render( 'booking.twig', array(
            'message' => 'Sie haben dieses Ferienhaus schon gebucht.',
            'message_class' => 'alert alert-dismissable alert-danger',
            'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.',
            'value' => $postdata
        ) ), 404 );        
    }
    //Ansonsten Vertrag speichern
    else
    {
        saveContract( $urlParameters->query->all()['id'], $urlParameters->query->all(), $getCustomer['id_kunde'], $app );          
        return new Response( $app['twig']->render( 'booking.twig', array(
            'message' => 'Ihre Daten wurden aufgenommen. Sie erhalten demnächst eine Rechnung per Mail.',
            'message_class' => 'alert alert-dismissable alert-success',    
            'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.'
        ) ), 201 );   
    }
}
//Reservieren und Kunde speichern wenn funktion nicht false zurückgibt
elseif( saveCustomer( $postdata, $app ) != false )
{    
    saveContract( $urlParameters->query->all()['id'], $urlParameters->query->all(), getCustomer( $postdata, $app )['id_kunde'], $app );          
    return new Response( $app['twig']->render( 'booking.twig', array(
        'message' => 'Ihre Daten wurden aufgenommen. Sie erhalten demnächst eine Rechnung per Mail.',
        'message_class' => 'alert alert-dismissable alert-success',    
        'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.'
    ) ), 201 );
}
else
{
    return new Response( $app['twig']->render( 'booking.twig', array(
        'message' => 'Ihre Daten konnten nicht gespeichert werden. Versuchen Sie es erneut.',
        'message_class' => 'alert alert-dismissable alert-danger',
        'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.',
        'value' => $postdata
    ) ), 404 );
}