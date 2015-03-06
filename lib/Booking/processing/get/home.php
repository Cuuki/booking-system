<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'home.twig' ), 201 );
