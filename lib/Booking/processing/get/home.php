<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'home.twig', array(
    'description' => 'Hier können Sie Ferienhäuser anhand der eingegebenen Regionen oder Orte finden.'
) ), 201 );
