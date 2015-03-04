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
        . 'WHERE CONTAINS(Column, region) = "Amerika"';

echo "<pre>";
var_dump($postdata['standort']);
var_dump($select);
echo "</pre>";

$searchResults = $app['db']->fetchAssoc( $select
);

return new Response( $app['twig']->render( 'booking.twig', array(
    'output' => $searchResults
) ), 201 );
