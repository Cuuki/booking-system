<?php

namespace Adminpanel;

use Silex\Application;
use Silex\ControllerProviderInterface;
use Symfony\Component\HttpFoundation\Request;

define( 'ADMIN_DIR', realpath( __DIR__ . '/../lib/Admin' ) );

class AdminpanelControllerProvider implements ControllerProviderInterface
{

    public function connect ( Application $app )
    {
        // Dateien einbinden
        include_once __DIR__ . '/../adminpanel/user/sudo-config.php';

        $controllers = $app['controllers_factory'];

        $controllers->get( '/', function () use ( $app )
        {
            return $app->redirect( 'user/dashboard/' );
        } );

        $controllers->get( 'user/', function () use ( $app )
        {
            return $app->redirect( 'dashboard/' );
        } );

        $controllers->get( 'auth/', function () use ( $app )
        {
            return $app->redirect( 'login' );
        } );

        //Dashboard 
        $controllers->get( 'user/dashboard/', function () use ( $app )
        {
            return include_once USER_DIR . '/dashboard/processing/get/processing_dashboard.php';
        } )->bind( 'dashboard' );

        $this->bindAuth( $app, $controllers, $apFunctions );
        $this->bindReset( $app, $controllers );
        $this->bindSettings( $app, $controllers, $apFunctions );
        $this->bindUser( $app, $controllers, $apFunctions, $gbFunctions );
        $this->bindPosts( $app, $controllers, $gbFunctions );

        return $controllers;
    }

    private function bindAuth ( Application $app, $controllers, $apFunctions )
    {
        //Login        
        $controllers->get( 'auth/login', function () use ( $app )
        {
            return include_once ROUTES_DIR . '/auth/processing/get/processing_login.php';
        } )->bind( 'login' );

        $controllers->post( 'auth/login', function ( Request $username, Request $password, Request $staylogged ) use ( $app, $apFunctions )
        {
            return include_once ROUTES_DIR . '/auth/processing/post/processing_login.php';
        } );

        // Logout
        $controllers->get( 'user/dashboard/logout', function () use ( $app )
        {
            return include_once ROUTES_DIR . '/auth/processing/get/processing_logout.php';
        } )->bind( 'logout' );

        return $controllers;
    }

    private function bindUser ( Application $app, $controllers, $apFunctions, $gbFunctions )
    {
        // Benutzer hinzufügen
        $controllers->get( 'user/dashboard/add', function () use ( $app )
        {
            return include_once USER_DIR . '/dashboard/processing/get/processing_add.php';
        } )->bind( 'add' );

        $controllers->post( 'user/dashboard/add', function ( Request $username, Request $useremail, Request $password ) use ( $app, $apFunctions, $gbFunctions )
        {
            return include_once USER_DIR . '/dashboard/processing/post/processing_add.php';
        } );

        // Benutzerdaten bearbeiten
        $controllers->get( 'user/dashboard/update/', function ( Request $currentpage ) use ( $app, $apFunctions )
        {
            return include_once USER_DIR . '/dashboard/display/display_update.php';
        } )->bind( 'update' );

        $controllers->get( 'user/dashboard/update/{id}', function ( $id ) use ( $app, $apFunctions, $gbFunctions )
        {
            return include_once USER_DIR . '/dashboard/display/display_update_id.php';
        } );

        $controllers->post( 'user/dashboard/update/{id}', function ( $id, Request $username, Request $useremail, Request $password ) use ( $app, $apFunctions, $gbFunctions )
        {
            return include_once USER_DIR . '/dashboard/processing/post/processing_update_id.php';
        } );

        return $controllers;
    }

}
