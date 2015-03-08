<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'search.twig', array(
            'headline' => 'Benutzer hinzufügen',
            'is_active_suchen' => true,
            'submitvalue' => 'Anlegen'
        ) ), 201 );
