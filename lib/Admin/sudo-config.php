<?php

// lege admin an, wenn nicht schon vorhanden
if ( getUserByName( $app['db'], 'adm' ) == NULL )
{
    $admin = array(
        'username' => 'adm',
        'useremail' => 'adm@example.de',
        'password' => 'adm'
    );

    saveUser( $admin, $app['db'] );
}