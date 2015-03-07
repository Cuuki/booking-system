<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'username' => $username->get( 'username' ),
    'useremail' => $useremail->get( 'useremail' ),
    'password' => $password->get( 'password' )
);

$sanitizeUser = sanitizeUser( $postdata );
$invalidInput = validate( $sanitizeUser );

if ( !empty( $invalidInput ) )
{
    return new Response( $app['twig']->render( 'user_add.twig', array(
                'errormessages' => getErrorMessages( $invalidInput ),
                'postdata' => $postdata,
                'is_active_usermanagement' => true,
                'headline' => 'Benutzer hinzufügen',
                'submitvalue' => 'Anlegen'
            ) ), 404 );
}
else
{
    foreach ( getAllUsers( $app['db'] ) as $user )
    {
        $usernames[] = $user['username'];
        $useremails[] = $user['email'];
    }

    if ( in_array( $postdata['username'], $usernames, true ) || in_array( $postdata['useremail'], $useremails, true ) )
    {
        return new Response( $app['twig']->render( 'user_add.twig', array(
                    'message' => 'Der Benutzer existiert bereits.',
                    'message_type' => 'alert alert-dismissable alert-danger',
                    'is_active_usermanagement' => true,
                    'headline' => 'Benutzer hinzufügen',
                    'submitvalue' => 'Anlegen'
                ) ), 404 );
    }
    elseif ( saveUser( $postdata, $app['db'] ) )
    {

        return new Response( $app['twig']->render( 'user_add.twig', array(
                    'message' => 'Der Benutzer wurde hinzugefügt.',
                    'message_type' => 'alert alert-dismissable alert-success',
                    'is_active_usermanagement' => true,
                    'headline' => 'Benutzer hinzufügen',
                    'submitvalue' => 'Anlegen'
                ) ), 201 );
    }
    else
    {
        return new Response( $app['twig']->render( 'user_add.twig', array(
                    'message' => 'Der Benutzer konnte nicht gespeichert werden!',
                    'message_type' => 'alert alert-dismissable alert-danger',
                    'is_active_usermanagement' => true,
                    'headline' => 'Benutzer hinzufügen',
                    'submitvalue' => 'Anlegen'
                ) ), 404 );
    }
}
