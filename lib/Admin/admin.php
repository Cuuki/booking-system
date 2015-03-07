<?php

/**
 * @return stmt
 */
function saveUser ( array $params, $db )
{
    $insert = 'INSERT INTO
                    admin(username, email, passwort)
                VALUES
                (
                    :username,
                    :email,
                    :passwort
                )';

    return $db->executeQuery( $insert, array(
                'username' => $params["username"],
                'email' => $params["useremail"],
                'passwort' => password_hash( $params["password"], PASSWORD_BCRYPT )
            ) );
}

/**
 * @return array
 */
function getUserByName ( $db, $username )
{
    $select = 'SELECT * FROM admin WHERE username = ?';

    return $db->fetchAssoc( $select, array( $username ) );
}

/**
 * @return array
 */
function getUserByID ( $db, $id )
{
    $select = 'SELECT * FROM admin WHERE id_admin = ?';

    return $db->fetchAssoc( $select, array( $id ) );
}

/**
 * @return array
 */
function getAllUsers ( $db )
{
    $select = 'SELECT * FROM admin';

    return $db->fetchAll( $select );
}