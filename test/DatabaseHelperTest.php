<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "../db/DatabaseHelper.php";
use PHPUnit\Framework\TestCase;

final class DatabaseHelperTest extends TestCase
{
    private DatabaseHelper $db;
    private bool $db_created = false;

    public function setUp(): void
    {
        if ($this->db_created === false) {
            $this->db = new DatabaseHelper();
            $this->db_created = true;
        }
        //assert($this->db !== null);
        //echo "Database loaded successfully\n";
    }

    public function testConnection()
    {
        $this->assertNotNull($this->db, "Connected to database");
    }

    public function testQuicksort()
    {
        //$test = $this->db->qsort(array(2, 5, 1, 4, 3));
        $this->assertEquals(
            array(
                array("time" => 5),
                array("time" => 4),
                array("time" => 3),
                array("time" => 2),
                array("time" => 1)),
            $this->db->quick_sort(array(
                array("time" => 2),
                array("time" => 5),
                array("time" => 1),
                array("time" => 4),
                array("time" => 3)),
                "time", true
            ));
    }

    public function testFindLogin()
    {
        $this->assertNull($this->db->findLogin("hahaha", "hehehe"));
        $this->assertNull($this->db->findLogin("", ""));
        $this->assertNotNull($this->db->findLogin("valent", "password"));
        $this->assertNull($this->db->findLogin("valent", "PaSSwoRd"));
    }

    public function testCreatePost()
    {
        $this->assertTrue($this->db->createPost("iewuohrogunveufg", "valent"));
    }

}

//$test = new DatabaseHelper();
//echo '<pre>' , var_dump($test) , '</pre>';
//$test->createUser("valent", "Francesco Valentini", "fv26012001@gmail.com", "password", "hehe");
//$test->createUser("_annavalentini", "Anna Valentini", "anna.vale107a@gmail.com", "password", "haha");
//$test->createUser("val_orosa", "Valentina Di Bernardo", "sonolavale@taaaac.com", "password", "taaaac");
//echo '<pre>' , var_dump($test->searchUser("Val")) , '</pre>';
//$test->createPost("lorem ipsum dolor sticazzi", "valent", array("hihi", "hoho", "lol"));
//$test->createComment("Scemo chi legge", "valent", "0000000000000000");
