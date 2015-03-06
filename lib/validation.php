<?php

/** 
 * @return array
 */
function sanitizeBooking ( array $params )
{
    $data = array(
        // eingaben nach ungültigen Zeichen filtern
        "firstname" => trim( filter_var( $params["firstname"], FILTER_SANITIZE_STRING ) ),
        "lastname" => trim( filter_var( $params["lastname"], FILTER_SANITIZE_STRING ) ),
        "email" => filter_var( trim( $params["email"] ), FILTER_VALIDATE_EMAIL ),
        "plz" => trim( filter_var( $params["plz"], FILTER_SANITIZE_NUMBER_INT ) ),
        "ort" => trim( filter_var( $params["ort"], FILTER_SANITIZE_STRING ) ),
        "straße" => trim( filter_var( $params["straße"], FILTER_SANITIZE_STRING ) )
    );

    if ( strlen( $data['plz'] ) > 10 )
    {
        $data['plz'] = false;
    }    
    
    return $data;
}

/**
 * @return array
 */
function validateForm ( array $params )
{
    // wenn vorher gefilterte Eingaben leer sein sollten oder false gib Array mit falschen Schlüssel zurück
    $invalidKeys = array();

    foreach ( $params as $key => $value )
    {
        if ( empty( $value ) )
        {
            $invalidKeys[] = $key;
        }
    }

    return $invalidKeys;
}

/**
 * @return array
 */
function getErrormessages ( $invalidInput )
{
    $errorMessages = array();

    foreach ( $invalidInput as $key => $value )
    {
        // bei ungültiger Eingabe der Felder Fehler in array speichern
        switch ( $value )
        {
            case "firstname":
                $errorMessages[$value] = "Bitte geben Sie einen validen Vornamen ein. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;

            case "lastname":
                $errorMessages[$value] = "Bitte geben Sie einen validen Nachnamen ein. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;

            case "email":
                $errorMessages[$value] = "Bitte geben Sie eine gültige E-Mail-Adresse ein. Beispiel: test@example.com";
                break;

            case "plz":
                $errorMessages[$value] = "Geben Sie eine PLZ aus nicht mehr als 10 Zahlen an. Die PLZ besteht nur aus Zahlen.";
                break;

            case "ort":
                $errorMessages[$value] = "Bitte geben Sie Ihren Wohnort ein. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;

            case "straße":
                $errorMessages[$value] = "Bitte geben Sie Ihre Straße und Hausnummer ein. Verwenden Sie keine Sonderzeichen.";
                break;
        }
    }

    return $errorMessages;
}