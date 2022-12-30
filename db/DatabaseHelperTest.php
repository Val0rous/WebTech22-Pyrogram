<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("DatabaseHelper.php");

/*
final class DatabaseHelperTest
{
    private $db;

    public function __construct()
    {
        $this->db = new DatabaseHelper("localhost", "root", "", "pyrogram", 3306);
        assert($this->db !== null);
        echo "Database loaded successfully\n";
    }    
}
*/

$test = new DatabaseHelper();
//echo '<pre>' , var_dump($test) , '</pre>';
//$test->createUser("valent", "Francesco Valentini", "fv26012001@gmail.com", "password", "hehe");
//$test->createUser("_annavalentini", "Anna Valentini", "anna.vale107a@gmail.com", "password", "haha");
//$test->createUser("val_orosa", "Valentina Di Bernardo", "sonolavale@taaaac.com", "password", "taaaac");
echo '<pre>' , var_dump($test->searchUser("Val")) , '</pre>';
//$test->createPost("lorem ipsum dolor sticazzi", "valent", array("hihi", "hoho", "lol"));
//$test->createComment("Scemo chi legge", "valent", "0000000000000000");
