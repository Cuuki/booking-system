<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'booking.twig', array(
    'description' => 'Geben Sie Ihre Daten ein um das Ferienhaus zu buchen.'
) ), 201 );
