<?php

/** 
 * @return array
 */
function sanitizeSearch ( array $params )
{
    $data = array(
        // eingaben nach ungültigen Zeichen filtern
        "region" => trim( filter_var( $params["region"], FILTER_SANITIZE_STRING ) ),
        "ort" => trim( filter_var( $params["ort"], FILTER_SANITIZE_STRING ) ),
        "gaeste" => filter_var( trim( $params["gaeste"] ), FILTER_SANITIZE_NUMBER_INT ),
    );
    
    return $data;
}

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
function sanitizeComplain ( array $params )
{
    $data = array(
        // eingaben nach ungültigen Zeichen filtern
        "beschreibung" => trim( filter_var( $params["beschreibung"], FILTER_SANITIZE_STRING ) ),
        "email" => filter_var( trim( $params["email"] ), FILTER_VALIDATE_EMAIL ),
        "bezeichnung" => trim( filter_var( $params["bezeichnung"], FILTER_SANITIZE_STRING ) )
    );

    if ( strlen( $data['beschreibung'] ) > 1000 )
    {
        $data['beschreibung'] = false;
    }    
    
    return $data;
}

/**
 * @return array
 */
function sanitizeUser ( array $params )
{
    $data = array(
        "username" => filter_var( trim( $params["username"] ), FILTER_SANITIZE_STRING ),
        "useremail" => filter_var( trim( $params["useremail"] ), FILTER_VALIDATE_EMAIL ),
        "password" => filter_var( trim( $params["password"] ), FILTER_SANITIZE_STRING )
    );

    return $data;
}

/**
 * @return array
 */
function sanitizeBankdata ( array $params )
{
    $data = array(
        "beguenstigter" => filter_var( trim( $params["beguenstigter"] ), FILTER_SANITIZE_STRING ),
        "iban" => filter_var( trim( $params["iban"] ), FILTER_SANITIZE_STRING ),
        "bic" => filter_var( trim( $params["bic"] ), FILTER_SANITIZE_STRING ),
        "bank" => filter_var( trim( $params["bank"] ), FILTER_SANITIZE_STRING ),
        "verwendungszweck" => filter_var( trim( $params["verwendungszweck"] ), FILTER_SANITIZE_STRING )
    );

    return $data;
}

/**
 * @return array
 */
function validate ( array $params )
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
            
            case "region":
                $errorMessages[$value] = "Bitte geben Sie eine valide Region ein. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;

            case "gaeste":
                $errorMessages[$value] = "Bitte geben Sie eine Nummer als Anzahl der Gäste ein.";
                break;
            
            case "bezeichnung":
                $errorMessages[$value] = "Bitte geben Sie eine valide Bezeichnung an. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;

            case "beschreibung":
                $errorMessages[$value] = "Bitte geben Sie eine valide Beschreibung an. Verwenden Sie keine Leer- oder Sonderzeichen.";
                break;
            
            case "username":
                $errorMessages[$value] = "Bitte geben Sie einen Usernamen ein. Lassen Sie das Feld nicht frei und verwenden Sie keine Sonderzeichen.";
                break;

            case "useremail":
                $errorMessages[$value] = "Bitte geben Sie eine gültige E-Mail-Adresse ein. Sie sollte wie folgendes Beispiel aussehen: test@example.com";
                break;

            case "password":
                $errorMessages[$value] = "Bitte geben Sie ein sicheres Passwort ein. Lassen Sie das Feld nicht frei.";
                break;    
            
            case "beguenstigter":
                $errorMessages[$value] = "Bitte geben Sie den Namen des Begünstigten/Firma ein. Lassen Sie das Feld nicht frei.";
                break;  
            
            case "iban":
                $errorMessages[$value] = "Bitte geben Sie eine valide IBAN (22 stellig) ein. Beispiel: DE21301204000000015228";
                break;  
            
            case "bic":
                $errorMessages[$value] = "Bitte geben Sie eine valide BIC ein. Beispiel: BYLADEM1HOS";
                break; 
            
            case "bank":
                $errorMessages[$value] = "Bitte geben Sie den Namen der Bank ein. Lassen Sie das Feld nicht frei.";
                break;  
            
            case "verwendungszweck":
                $errorMessages[$value] = "Bitte geben Sie einen Verwendungszweck an. Lassen Sie das Feld nicht frei.";
                break;
        }
    }

    return $errorMessages;
}