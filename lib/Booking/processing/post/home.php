<?php

use Symfony\Component\HttpFoundation\Response;

include_once BOOKING_DIR . '/processing/search.php';

$postdata = array(
    'region' => $region->get( 'region' ),
    'ort' => $ort->get( 'ort' ),
    'beginn' => $beginn->get( 'beginn' ),
    'ende' => $ende->get( 'ende' ),
    'gaeste' => $gaeste->get( 'gaeste' )
);

$sanitizeSearch = sanitizeSearch( $postdata );
$invalidInput = validate( $sanitizeSearch );

if( !empty( $invalidInput ) )
{
    return new Response( $app['twig']->render( 'home.twig', array(
        'errormessages' => getErrormessages( $invalidInput ),
        'description' => 'Hier können Sie Ferienhäuser anhand der eingegebenen Regionen oder Orte finden.',
        'value' => $postdata
    ) ), 404 );
}

$searchResults = search( $postdata, $app );

if ( !$searchResults )
{
    return new Response( $app['twig']->render( 'home.twig', array(
        'message' => 'Keine Ergebnisse gefunden.',
        'description' => 'Hier können Sie Ferienhäuser anhand der eingegebenen Regionen oder Orte finden.',
        'value' => $postdata
    ) ), 404 );
}

return new Response( $app['twig']->render( 'home.twig', array(
    'output' => $searchResults,
    'description' => 'Hier können Sie Ferienhäuser anhand der eingegebenen Regionen oder Orte finden.',
    'value' => $postdata
) ), 201 );
