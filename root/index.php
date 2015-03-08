<?php

error_reporting( E_ALL );
ini_set( 'log_errors', 1 );

// Dateien einbinden
require_once __DIR__ . '/../vendor/autoload.php';
include_once __DIR__ . '/../ControllerProvider/BookingControllerProvider.php';
include_once __DIR__ . '/../ControllerProvider/AdminpanelControllerProvider.php';

$app = new Silex\Application();

$app->register( new Silex\Provider\UrlGeneratorServiceProvider() );
$app->register( new Silex\Provider\SessionServiceProvider() );
$app->register( new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__ . '/../templates'
) );

$dbname = fread( fopen( __DIR__ . '/../.secure/dbname', 'r' ), filesize( __DIR__ . '/../.secure/dbname' ) );
$user = fread( fopen( __DIR__ . '/../.secure/user', 'r' ), filesize( __DIR__ . '/../.secure/user' ) );
$password =  fread( fopen( __DIR__ . '/../.secure/pass', 'r' ), filesize( __DIR__ . '/../.secure/pass' ) );

//Datenbankverbindung registrieren
$app->register( new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
        'driver' => 'pdo_mysql',
        'dbname' => $dbname,
        'user' => $user,
        'password' => $password,
        'host' => 'localhost',
        'charset' => 'utf8',
    )
) );

$app['debug'] = TRUE;

mb_internal_encoding("UTF-8");

$app->mount( '/bks', new Booking\BookingControllerProvider() );
$app->mount( '/ap', new Adminpanel\AdminpanelControllerProvider() );

$app['session.storage.options'] = array(
    'lifetime' => 1800
);

$app->before( function () use ( $app )
{
    $getPath = $app['request_context']->getPathInfo();

    //Wenn Session null dann true und führe aus, wenn Session nicht null dann false und führe nicht aus
    if ( !$app['session']->get( 'user' ) )
    {
        // Wenn Pfad = auth/login dann nicht redirecten
        if ( $getPath == '/ap/auth/login' || $getPath == '/bks/' || $getPath == '/bks/booking' || $getPath == '/bks/complaint' )
        {
            return;
        }
        return $app->redirect( $app['url_generator']->generate( 'login' ) );
    }
} );

// Loginsession starten
$app['session']->start();

// Letzte Aktivität in der Session
$sessionLastUsed = $app['session']->getMetadataBag()->getLastUsed();

//User aus Session abfragen
$loggeduser = $app['session']->get( 'user' );

//Standardroute festlegen für Sources
$app['twig']->addGlobal('base_url', 'http://localhost/booking-system/root');
$app['twig']->addGlobal('loggeduser', $loggeduser);

// Wenn nach 15 Minuten (900sek) keine Aktivität in der Session war und das Cookie Lifetime nicht 0 ist zerstöre diese
if ( ( $app['session']->get( 'cookie_lifetime' ) !== 0 ) && ( time() - $sessionLastUsed > 900 ) )
{
    session_destroy();
}

$app->run();
