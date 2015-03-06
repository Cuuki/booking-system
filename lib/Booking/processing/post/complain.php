<?php

use Symfony\Component\HttpFoundation\Response;

include_once BOOKING_DIR . '/../validation.php';
include_once BOOKING_DIR . '/processing/complaint.php';

$postdata = array(
    'beschreibung' => $beschreibung->get( 'beschreibung' ),
    'bezeichnung' => $bezeichnung->get( 'bezeichnung' ),
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
