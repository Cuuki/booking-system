<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'standort' => $standort->get( 'standort' ),
    'beginn' => $beginn->get( 'beginn' ),
    'ende' => $ende->get( 'ende' ),
    'gaeste' => $gaeste->get( 'gaeste' )
);

//in mietvertrag speichern
$postdata['beginn'];
$postdata['ende'];

$select = 'SELECT bezeichnung, schlafzimmer, betten, objekt_plz, objekt_adresse '
        . 'FROM ferienhaus '
        . 'INNER JOIN standort '
        . 'ON ferienhaus.id_ferienhaus = standort.id_ferienhaus '
        . 'WHERE region LIKE CONCAT( "%", SUBSTRING(?, 1,4), "%" ) '
        . 'OR ort LIKE CONCAT( "%", SUBSTRING(?, 1,2), "%" )';

$searchResults = $app['db']->fetchAssoc( $select, array(
    $postdata['standort'], $postdata['standort']
) );

if ( !$searchResults )
{
    return new Response( $app['twig']->render( 'booking.twig', array(
        'message' => 'Keine Ergebnisse gefunden.'
    ) ), 404 );
}

return new Response( $app['twig']->render( 'booking.twig', array(
    'output' => $searchResults
) ), 201 );
