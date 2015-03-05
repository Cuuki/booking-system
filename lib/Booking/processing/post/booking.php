<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'standort' => $standort->get( 'standort' ),
    'beginn' => $beginn->get( 'beginn' ),
    'ende' => $ende->get( 'ende' ),
    'gaeste' => $gaeste->get( 'gaeste' )
);

$select = 'SELECT bezeichnung, schlafzimmer, betten, preis, objekt_plz, '
            . 'objekt_adresse, verfuegbar_anfang, verfuegbar_ende '
        . 'FROM ferienhaus '
        . 'INNER JOIN standort '
            . 'ON ferienhaus.id_ferienhaus = standort.id_ferienhaus '
        . 'WHERE region LIKE CONCAT( "%", SUBSTRING(?, 1,4), "%" ) '
            . 'OR ort LIKE CONCAT( "%", SUBSTRING(?, 1,2), "%" ) '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND schlafzimmer >= ?';

$searchResults = $app['db']->fetchAssoc( $select, array(
    $postdata['standort'],
    $postdata['standort'],
    $postdata['beginn'],
    $postdata['ende'],
    $postdata['gaeste']
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
