<?php

/** 
 * @return array
 */
function search( $postdata, $app )
{
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

    return $app['db']->fetchAll( $select, array(
        $postdata['region'],
        $postdata['ort'],    
        $postdata['beginn'],
        $postdata['ende'],
        $postdata['gaeste']
    ));
}