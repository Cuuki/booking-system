<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'region' => $region->get( 'region' ),
    'ort' => $ort->get( 'ort' ),
    'beginn' => $beginn->get( 'beginn' ),
    'ende' => $ende->get( 'ende' ),
    'gaeste' => $gaeste->get( 'gaeste' )
);

$select = 'SELECT bezeichnung, schlafzimmer, betten, preis, objekt_plz, '
            . 'objekt_adresse, verfuegbar_anfang, verfuegbar_ende '
        . 'FROM ferienhaus '
        . 'INNER JOIN standort '
            . 'ON ferienhaus.id_ferienhaus = standort.id_ferienhaus '
        . 'WHERE region LIKE CONCAT( "%", ?, "%" ) '
            . 'AND ort LIKE CONCAT( "%", ?, "%" ) '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND schlafzimmer >= ?';

$searchResults = $app['db']->fetchAssoc( $select, array(
    $postdata['region'],
    $postdata['ort'],    
    $postdata['beginn'],
    $postdata['ende'],
    $postdata['gaeste']
) );

if ( !$searchResults )
{
    return new Response( $app['twig']->render( 'booking.twig', array(
        'message' => 'Keine Ergebnisse gefunden.',
        'value' => $postdata
    ) ), 404 );
}

return new Response( $app['twig']->render( 'booking.twig', array(
    'output' => $searchResults,
    'value' => $postdata
) ), 201 );
