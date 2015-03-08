<?php

use Symfony\Component\HttpFoundation\Response;


return new Response( $app['twig']->render( 'invoice_id.twig', array(
            'headline' => 'Benutzer hinzufügen',
            'is_active_rechnung' => true,
            'submitvalue' => 'Anlegen'
        ) ), 201 );
