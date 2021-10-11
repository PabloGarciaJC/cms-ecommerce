<?php

 class Database{
    static public function connect(){
        $db = new mysqli('localhost','root','','pablogarciajc_ecommerce','3306');
        $db->query("SET NAMES 'utf8'");
        return $db;
    }
}
