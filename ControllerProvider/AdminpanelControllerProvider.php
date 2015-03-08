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
        include_once ADMIN_DIR . '/admin.php';
        include_once __DIR__ . '/../lib/validation.php';
        include_once ADMIN_DIR . '/sudo-config.php';

        $controllers = $app['controllers_factory'];

        $controllers->get( '/', function () use ( $app )
        {
            return $app->redirect( $app['url_generator']->generate('dashboard') );
        } );

        $controllers->get( 'auth/', function () use ( $app )
        {
            return $app->redirect( $app['url_generator']->generate('login') );
        } );

        //Dashboard 
        $controllers->get( 'dashboard/', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/dashboard.php';
        } )->bind( 'dashboard' );             
        
        $this->bindAuth( $app, $controllers );
        $this->bindUser( $app, $controllers );
        $this->bindInvoice( $app, $controllers );
        $this->bindSearch( $app, $controllers );

        return $controllers;
    }

    private function bindAuth ( Application $app, $controllers )
    {
        //Login        
        $controllers->get( 'auth/login', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/login.php';
        } )->bind( 'login' );

        $controllers->post( 'auth/login', function ( Request $username, Request $password, Request $staylogged ) use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/post/login.php';
        } );

        // Logout
        $controllers->get( 'user/dashboard/logout', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/logout.php';
        } )->bind( 'logout' );

        return $controllers;
    }

    private function bindUser ( Application $app, $controllers )
    {
        // Benutzer hinzufügen
        $controllers->get( 'dashboard/add', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/user_add.php';
        } )->bind( 'user_add' );

        $controllers->post( 'dashboard/add', function ( Request $username, Request $useremail, Request $password ) use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/post/user_add.php';
        } );

        return $controllers;
    }  
    
    private function bindInvoice ( Application $app, $controllers )
    {
        $controllers->get( 'dashboard/invoice', function ( Request $currentpage ) use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/invoice.php';
        } )->bind( 'invoice' );     
        
        $controllers->get( 'dashboard/invoice/{id}', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/invoice_id.php';
        } );             
        
        $controllers->post( 'dashboard/invoice/{id}', function ( $id, Request $urlParameters, Request $beguenstigter, Request $iban, Request $bic, Request $bank, Request $verwendungszweck ) use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/post/invoice_id.php';
        } ); 

        return $controllers;
    }   
    
    private function bindSearch ( Application $app, $controllers )
    {
        $controllers->get( 'dashboard/search', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/get/search.php';
        } )->bind( 'search' );     
        
        $controllers->post( 'dashboard/search', function () use ( $app )
        {
            return include_once ADMIN_DIR . '/processing/post/search.php';
        } );     

        return $controllers;
    }       
    
}
