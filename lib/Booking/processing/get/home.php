<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'booking.twig' ), 201 );
