<?php 

function db( $con ){
        
    if( session('scodigo') != '' ) {
        // reconnect 
        $custom = [
            'DSN'      => '',
            'hostname' => 'localhost',
            'username' => 'root',
            'password' => '',
            'database' => 'admaula_bdcarmelo_2021',
            'DBDriver' => 'MySQLi',
            'DBPrefix' => '',
            'pConnect' => false,
            'DBDebug'  => true,
            'charset'  => 'utf8',
            'DBCollat' => 'utf8_general_ci',
            'swapPre'  => '',
            'encrypt'  => false,
            'compress' => false,
            'strictOn' => false,
            'failover' => [],
            'port'     => 3306,
        ];
        if( $db = \Config\Database::connect($custom) ) {
            return $db;
        }
    } else {
        return $con;
    }
    // end connect
}