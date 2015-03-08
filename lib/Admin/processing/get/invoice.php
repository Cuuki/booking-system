<?php

use Symfony\Component\HttpFoundation\Response;

//Alle Mietverträge anzeigen und bei 'Rechnung erstellen' Weiter auf invoice id
//Dann weitere Daten eintragen und weiter an kunden

include_once ADMIN_DIR . '/pagination.php';
$totalentries = totalEntries( $app['db'] );
include_once ADMIN_DIR . '/processing/get/pagination.php';
include_once ADMIN_DIR . '/processing/invoice.php';

return new Response( $app['twig']->render( 'invoice.twig', array(
            'leases' => getAllLeases( $app, $currentpage, $rowsperpage ),
            'is_active_rechnung' => true,
            'firstpage' => $firstPage,
            'currentpage' => $currentpage,
            'pagenumber' => $pageNumber,
            'nextpage' => $nextPage,
            'previouspage' => $previousPage,
            'lastpage' => $lastPage,
            'pages_before' => $pagesBefore,
            'pages_after' => $pagesAfter,
        ) ), 201 );
