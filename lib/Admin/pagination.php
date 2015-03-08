<?php

/**
 * @return int
 */
function totalEntries ( $db )
{
    $select = "SELECT COUNT(*) as anzahl FROM mietvertrag";
    $row = $db->fetchColumn( $select );

    return (int) $row;
}

/**
 * @return float
 */
function totalPages ( $count, $rowsperpage )
{
    // Maximale Seitenzahl berechnen
    return ceil( $count / $rowsperpage );
}
