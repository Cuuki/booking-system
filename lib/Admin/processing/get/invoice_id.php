<?php

use Symfony\Component\HttpFoundation\Response;

return new Response( $app['twig']->render( 'invoice_id.twig', array(
            'is_active_rechnung' => true
        ) ), 201 );
