<?php

use Symfony\Component\HttpFoundation\Response;

include_once BOOKING_DIR . '/../validation.php';
include_once BOOKING_DIR . '/processing/complaint.php';

$postdata = array(
    'beschreibung' => $beschreibung->get( 'beschreibung' ),
    'bezeichnung' => $bezeichnung->get( 'bezeichnung' ),
    'email' => $email->get( 'email' )
);

$sanitizeComplain = sanitizeComplain( $postdata );
$invalidInput = validate( $sanitizeComplain );

if( !empty( $invalidInput ) )
{
    return new Response( $app['twig']->render( 'complain.twig', array(
        'errormessages' => getErrormessages( $invalidInput ),
        'description' => 'Geben Sie Ihre Beschwerde ein.',
        'value' => $postdata
    ) ), 404 );
}

$vacationID = getVacationID( $postdata['bezeichnung'], $app );
$customerID = getCustomerID( $postdata['email'], $app );

//ferienhaus bezeichnung mit einem aus datenbank vergleichen
if( $vacationID != false && $customerID != false )
{    
    //complaint speichern
    if( saveComplaint($postdata['beschreibung'], $vacationID, $customerID, $app) )
    {
        return new Response( $app['twig']->render( 'complain.twig', array(
            'message' => 'Ihre Beschwerde wurde entgegengenommen.',
            'message_class' => 'alert alert-dismissable alert-success',    
            'description' => 'Geben Sie Ihre Beschwerde ein.',
        ) ), 201 );
    }
    else
    {
        return new Response( $app['twig']->render( 'complain.twig', array(
            'message' => 'Ihre Beschwerde konnte nicht gespeichert werden. Versuchen Sie es erneut.',
            'message_class' => 'alert alert-dismissable alert-danger',            
            'description' => 'Geben Sie Ihre Beschwerde ein.',
            'value' => $postdata
        ) ), 404 );
    }
}
else
{
    return new Response( $app['twig']->render( 'complain.twig', array(
        'message' => 'Das Ferienhaus wurde nicht gefunden. Sie müssen außerdem ein Gast sein.',
        'message_class' => 'alert alert-dismissable alert-danger',        
        'description' => 'Geben Sie Ihre Beschwerde ein.',
        'value' => $postdata
    ) ), 404 );    
}