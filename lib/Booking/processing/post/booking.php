<?php

use Symfony\Component\HttpFoundation\Response;

$postdata = array(
    'firstname' => $standort->get( 'standort' ),
    'lastname' => $beginn->get( 'beginn' ),
    'email' => $ende->get( 'ende' ),
    'textinput' => $gaeste->get( 'gaeste' )
);

return new Response(implode(' / ', $postdata), 201);