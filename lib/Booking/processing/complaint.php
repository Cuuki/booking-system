<?php

function getCustomerID ( $customerdata, $app )
{
    $select = 'SELECT id_kunde FROM kunde WHERE email = ?';

    return $app['db']->fetchAssoc( $select, array( $customerdata ) ); 
}

function getVacationID ( $complaintdata, $app )
{
    $select = 'SELECT id_ferienhaus FROM ferienhaus WHERE bezeichnung = ?';

    return $app['db']->fetchAssoc( $select, array( $complaintdata ) );     
}

function saveComplaint ( $data, $vacationID, $customerID, $app )
{
    $insert = 'INSERT INTO
                    maengelanzeige(beschreibung, id_kunde, id_ferienhaus)
                VALUES
                (
                    :beschreibung,
                    :id_kunde,
                    :id_ferienhaus
                )';

    return $app['db']->executeQuery( $insert, array(
                'beschreibung' => $data,
                'id_kunde' => $customerID['id_kunde'],
                'id_ferienhaus' => $vacationID['id_ferienhaus']
            ) );    
}