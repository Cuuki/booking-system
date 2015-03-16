<?php

function getCustomer ( $customerdata, $app )
{
    $select = 'SELECT * FROM kunde WHERE email = ? AND vorname = ? AND nachname = ?';

    return $app['db']->fetchAssoc( $select, array( 
        $customerdata['email'], 
        $customerdata['firstname'], 
        $customerdata['lastname'] 
    ) ); 
}

function saveCustomer ( $params, $app )
{
    $insert = 'INSERT INTO
                    kunde(vorname, nachname, email, plz, ort, straße)
                VALUES
                (
                    :firstname,
                    :lastname,
                    :email,
                    :zip,
                    :city,
                    :street
                )';

    return $app['db']->executeQuery( $insert, array(
                'firstname' => $params["firstname"],
                'lastname' => $params["lastname"],
                'email' => $params["email"],
                'zip' => $params["plz"],
                'city' => $params["ort"],
                'street' => $params["straße"]   
            ) );    
}

function getContract ( $id, $customerdata, $app )
{
    $select = 'SELECT * FROM mietvertrag JOIN kunde ON mietvertrag.id_kunde = kunde.id_kunde WHERE email = ? AND vorname = ? AND nachname = ? AND id_ferienhaus = ?';
    
    return $app['db']->fetchAssoc( $select, array( 
        $customerdata['email'], 
        $customerdata['vorname'],
        $customerdata['nachname'],
        $id
    ) ); 
}

function saveContract ( $rentalId, $urlparams, $customerId, $app )
{
    $insert = 'INSERT INTO
                    mietvertrag(beginn, ende, id_ferienhaus, id_kunde)
                VALUES
                (
                    :beginn,
                    :ende,
                    :id_ferienhaus,
                    :id_kunde
                )';

    return $app['db']->executeQuery( $insert, array(
                'beginn' => $urlparams["beginn"],
                'ende' => $urlparams["ende"],
                'id_ferienhaus' => $rentalId,
                'id_kunde' => $customerId      
            ) );        
}