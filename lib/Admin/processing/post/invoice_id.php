<?php

use Symfony\Component\HttpFoundation\Response;

include_once ADMIN_DIR . '/processing/invoice.php';

$postdata = array(
    'beguenstigter' => $beguenstigter->get( 'beguenstigter' ),
    'iban' => $iban->get( 'iban' ),
    'bic' => $bic->get( 'bic' ),
    'bank' => $bank->get( 'bank' ),
    'verwendungszweck' => $verwendungszweck->get( 'verwendungszweck' )
);

$sanitizeBankdata = sanitizeBankdata( $postdata );
$invalidInput = validate( $sanitizeBankdata );

if ( !empty( $invalidInput ) )
{
    return new Response( $app['twig']->render( 'invoice_id.twig', array(
        'errormessages' => getErrormessages( $invalidInput ),
        'is_active_rechnung' => true,
        'value' => $postdata
    ) ), 404 );
}

$leas = getLeasByID( $app, $id );
$vacation = getVacationByID( $app, $urlParameters->query->all()['id_ferienhaus'] );
$customer = getCustomerByID( $app, $urlParameters->query->all()['id_kunde'] );

if( $leas != false && $vacation != false && $customer != false )
{
    $message = 'Sehr geehrter Herr ' . $customer['nachname'] . PHP_EOL . 
            'Unten finden Sie Ihre Kontaktdaten sowie die Bankdaten und den zu überweisenden Betrag.' . PHP_EOL . 
            'Anfang des Aufenthalts: ' . $leas['beginn'] . PHP_EOL . 
            'Ende des Aufenthalts: ' . $leas['ende'] . PHP_EOL .
            'Ihr Vorname: ' . $customer['vorname'] . PHP_EOL .
            'Ihr Nachname: ' . $customer['nachname'] . PHP_EOL .
            'Ihre Postleitzahl: ' . $customer['plz'] . PHP_EOL .
            'Ihr Wohnort: ' . $customer['ort'] . PHP_EOL .
            'Ihre Straße: ' . $customer['straße'] . PHP_EOL .
            'Name des Ferienhauses: ' . $vacation['bezeichnung'] . PHP_EOL .
            'Preis des Ferienhauses: ' . $vacation['preis'] . PHP_EOL . PHP_EOL . 
            'Zahlungsdaten: ' . PHP_EOL .
            'Begünstigter: ' . $postdata['beguenstigter'] . PHP_EOL .
            'IBAN: ' . $postdata['iban'] . PHP_EOL .
            'BIC: ' . $postdata['bic'] . PHP_EOL .
            'Name der Bank: ' . $postdata['bank'] . PHP_EOL .
            'Verwendungszweck: ' . $postdata['verwendungszweck'] . PHP_EOL;
    
    //Daten für Überweisung eintragen und dann Rechnung an Kunden
    mb_send_mail( mb_encode_mimeheader($customer['email']), 'Ihre Rechnung für die Buchung des Ferienhauses ' . 
            $vacation['bezeichnung'], $message, $headers = "Mime-Version: 1.0\n", 
            $headers .= "Content-Type: text/plain;charset=UTF-8\n");  
    
    return new Response( $app['twig']->render( 'invoice_id.twig', array(
        'is_active_rechnung' => true,
        'message_type' => 'alert alert-dismissable alert-success',
        'message' => 'Die Rechnung wurde abgeschickt.'
    ) ), 201 );
}
else
{
    return new Response( $app['twig']->render( 'invoice_id.twig', array(
        'is_active_rechnung' => true,
        'message_type' => 'alert alert-dismissable alert-danger',
        'message' => 'Die Rechnung konnte nicht abgeschickt werden.'
    ) ), 404 );
}
