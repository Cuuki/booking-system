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