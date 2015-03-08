<?php

use Symfony\Component\HttpFoundation\Response;

//Daten für Überweisung eintragen und dann Rechnung an Kunden
//beguenstigter, iban, bic, bank, verwendungszweck

return new Response( $app['twig']->render( 'invoice_id.twig', array(
            'is_active_rechnung' => true
        ) ), 201 );
