<?php

function getAllLeases( $app, $currentpage, $rowsperpage )
{
    $offset = ($currentpage - 1) * $rowsperpage;
//Join kunde mietvertrag ferienhaus
    $select = 'SELECT * FROM mietvertrag '
            . 'JOIN kunde ON mietvertrag.id_kunde = kunde.id_kunde '
            . 'JOIN ferienhaus ON mietvertrag.id_ferienhaus = ferienhaus.id_ferienhaus '
            . 'ORDER BY id_mietvertrag ASC LIMIT ' . (int) $offset . ', ' . (int) $rowsperpage . '';
    
    return $app['db']->fetchAll( $select );
}

/**
 * @return array
 */
function getLeasByID ( $app, $id )
{
    $select = 'SELECT * FROM mietvertrag WHERE id_mietvertrag = ?';

    return $app['db']->fetchAssoc( $select, array( $id ) );
}

/**
 * @return array
 */
function getVacationByID ( $app, $id )
{
    $select = 'SELECT * FROM ferienhaus WHERE id_ferienhaus = ?';

    return $app['db']->fetchAssoc( $select, array( $id ) );
}

/**
 * @return array
 */
function getCustomerByID ( $app, $id )
{
    $select = 'SELECT * FROM kunde WHERE id_kunde = ?';

    return $app['db']->fetchAssoc( $select, array( $id ) );
}