<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'region' => $region->get( 'region' ),
    'ort' => $ort->get( 'ort' ),
    'beginn' => $beginn->get( 'beginn' ),
    'ende' => $ende->get( 'ende' ),
    'gaeste' => $gaeste->get( 'gaeste' )
);

$select = 'SELECT bezeichnung, schlafzimmer, betten, preis, verfuegbar_anfang, '
        . 'verfuegbar_ende, plz, ort, straße '
        . 'FROM ferienhaus '
        . 'JOIN objekt_adresse '
            . 'ON ferienhaus.id_ferienhaus = objekt_adresse.id_ferienhaus '
        . 'WHERE region LIKE CONCAT( "%", ?, "%" ) '
            . 'AND ort LIKE CONCAT( "%", ?, "%" ) '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND ? BETWEEN verfuegbar_anfang AND verfuegbar_ende '
            . 'AND betten >= ?';

$searchResults = $app['db']->fetchAll( $select, array(
    $postdata['region'],
    $postdata['ort'],    
    $postdata['beginn'],
    $postdata['ende'],
    $postdata['gaeste']
));

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
