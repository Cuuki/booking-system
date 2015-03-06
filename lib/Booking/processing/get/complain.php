<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'complain.twig', array(
    'description' => 'Geben Sie Ihre Beschwerde ein.'
) ), 201 );
