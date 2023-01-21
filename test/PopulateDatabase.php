<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "../db/DatabaseHelper.php";
use PHPUnit\Framework\TestCase;

final class PopulateDatabase extends TestCase
{
    private DatabaseHelper $db;
    private bool $db_created = false;
    private $profile_pic = "img/default_profile_pic.jpg";
    private $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in purus tincidunt metus placerat ultrices. Curabitur eu convallis neque, quis rhoncus metus. Suspendisse id neque dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante urna, sodales at ultricies ut, tincidunt quis velit. In sed orci ut enim tempor consequat. Fusce magna libero, venenatis id ante nec, convallis aliquet turpis. Etiam ut felis sit amet ligula tincidunt dignissim a vitae nisi. Curabitur ornare nisi vitae tempor vehicula. Sed nisl ipsum, vulputate quis libero vel, aliquam dictum lacus. Vestibulum porta malesuada est et molestie. Pellentesque nec diam mauris. Proin condimentum sem leo, id aliquam ex semper at.";
    private $location = "Forlì";

    public function setUp(): void
    {
        if ($this->db_created === false) {
            $this->db = new DatabaseHelper();
            $this->db_created = true;
        }
    }

    public function testUsers()
    {
        $this->assertTrue($this->db->findUser("valent") || $this->db->createUser("valent", "Francesco Valentini", "fv26012001@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("fede") || $this->db->createUser("fede", "Federica Bedeschi", "federica.bedeschi@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("val_orosa") || $this->db->createUser("val_orosa", "Valentina Di Bernardo", "sonolavale@taaac.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("chuffo") || $this->db->createUser("chuffo", "Dario Ciuffolini", "ciuffothenew.milanese@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("euro") || $this->db->createUser("euro", "Eugenio Rossi", "orecchiaman@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("frenciu") || $this->db->createUser("frenciu", "Francesca Burgini", "pascalbellissimo@miao.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("doz") || $this->db->createUser("doz", "Riccardo Dotti", "performerfaentino@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("adam") || $this->db->createUser("adam", "Adam Paolo Razzino", "adamthegamer@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("lhollo") || $this->db->createUser("lhollo", "Lorenzo Boccali", "lollothepilot@flying.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("mancu") || $this->db->createUser("mancu", "Paolo Mancuso", "sonomafioso@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("guerrins") || $this->db->createUser("guerrins", "Francesca Guerrini", "im.guerrins@gmail.com", "password", $this->profile_pic));
        $this->assertTrue($this->db->findUser("toscanello") || $this->db->createUser("toscanello", "Lorenzo Barni", "barney@gmail.com", "password", $this->profile_pic));
    }

    public function testFollowings()
    {
        $this->assertFalse($this->db->createFollowing("valent", "valent"));
        $this->assertTrue($this->db->findFollowing("valent", "fede") || $this->db->createFollowing("valent", "fede"));
        $this->assertTrue($this->db->findFollowing("valent", "val_orosa") || $this->db->createFollowing("valent", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("valent", "chuffo") || $this->db->createFollowing("valent", "chuffo"));
        $this->assertTrue($this->db->findFollowing("valent", "euro") || $this->db->createFollowing("valent", "euro"));
        $this->assertTrue($this->db->findFollowing("valent", "frenciu") || $this->db->createFollowing("valent", "frenciu"));
        $this->assertTrue($this->db->findFollowing("valent", "doz") || $this->db->createFollowing("valent", "doz"));
        $this->assertTrue($this->db->findFollowing("valent", "adam") || $this->db->createFollowing("valent", "adam"));
        $this->assertTrue($this->db->findFollowing("valent", "lhollo") || $this->db->createFollowing("valent", "lhollo"));
        $this->assertTrue($this->db->findFollowing("valent", "mancu") || $this->db->createFollowing("valent", "mancu"));
        $this->assertTrue($this->db->findFollowing("valent", "guerrins") || $this->db->createFollowing("valent", "guerrins"));
        $this->assertTrue($this->db->findFollowing("valent", "toscanello") || $this->db->createFollowing("valent", "toscanello"));

        $this->assertFalse($this->db->createFollowing("fede", "fede"));
        $this->assertTrue($this->db->createFollowing("fede", "valent"));
        $this->assertTrue($this->db->createFollowing("fede", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("fede", "chuffo"));
        $this->assertTrue($this->db->createFollowing("fede", "euro"));
        $this->assertTrue($this->db->createFollowing("fede", "frenciu"));
        $this->assertTrue($this->db->createFollowing("fede", "doz"));
        $this->assertTrue($this->db->createFollowing("fede", "adam"));
        $this->assertTrue($this->db->createFollowing("fede", "lhollo"));
        $this->assertTrue($this->db->createFollowing("fede", "mancu"));
        $this->assertTrue($this->db->createFollowing("fede", "guerrins"));
        $this->assertTrue($this->db->createFollowing("fede", "toscanello"));

        $this->assertFalse($this->db->createFollowing("val_orosa", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("val_orosa", "fede"));
        $this->assertTrue($this->db->createFollowing("val_orosa", "valent"));
        $this->assertTrue($this->db->createFollowing("val_orosa", "chuffo"));
        

        $this->assertFalse($this->db->createFollowing("chuffo", "chuffo"));
        $this->assertTrue($this->db->createFollowing("chuffo", "fede"));
        $this->assertTrue($this->db->createFollowing("chuffo", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("chuffo", "valent"));
        $this->assertTrue($this->db->createFollowing("chuffo", "euro"));
        $this->assertTrue($this->db->createFollowing("chuffo", "frenciu"));
        $this->assertTrue($this->db->createFollowing("chuffo", "doz"));
        $this->assertTrue($this->db->createFollowing("chuffo", "adam"));
        
        $this->assertFalse($this->db->createFollowing("euro", "euro"));
        $this->assertTrue($this->db->createFollowing("euro", "fede"));
        $this->assertTrue($this->db->createFollowing("euro", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("euro", "chuffo"));
        $this->assertTrue($this->db->createFollowing("euro", "valent"));
        $this->assertTrue($this->db->createFollowing("euro", "frenciu"));
        $this->assertTrue($this->db->createFollowing("euro", "doz"));
        $this->assertTrue($this->db->createFollowing("euro", "adam"));
        $this->assertTrue($this->db->createFollowing("euro", "lhollo"));
        $this->assertTrue($this->db->createFollowing("euro", "mancu"));
        $this->assertTrue($this->db->createFollowing("euro", "guerrins"));
        $this->assertTrue($this->db->createFollowing("euro", "toscanello"));

        $this->assertFalse($this->db->createFollowing("frenciu", "frenciu"));
        $this->assertTrue($this->db->createFollowing("frenciu", "fede"));
        $this->assertTrue($this->db->createFollowing("frenciu", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("frenciu", "chuffo"));
        $this->assertTrue($this->db->createFollowing("frenciu", "euro"));
        $this->assertTrue($this->db->createFollowing("frenciu", "valent"));
        $this->assertTrue($this->db->createFollowing("frenciu", "doz"));
        $this->assertTrue($this->db->createFollowing("frenciu", "adam"));
        $this->assertTrue($this->db->createFollowing("frenciu", "lhollo"));
        $this->assertTrue($this->db->createFollowing("frenciu", "mancu"));
        $this->assertTrue($this->db->createFollowing("frenciu", "guerrins"));
        $this->assertTrue($this->db->createFollowing("frenciu", "toscanello"));

        $this->assertFalse($this->db->createFollowing("doz", "doz"));
        $this->assertTrue($this->db->createFollowing("doz", "fede"));
        $this->assertTrue($this->db->createFollowing("doz", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("doz", "chuffo"));
        $this->assertTrue($this->db->createFollowing("doz", "euro"));
        $this->assertTrue($this->db->createFollowing("doz", "frenciu"));
        $this->assertTrue($this->db->createFollowing("doz", "valent"));
        $this->assertTrue($this->db->createFollowing("doz", "adam"));
        $this->assertTrue($this->db->createFollowing("doz", "lhollo"));
        $this->assertTrue($this->db->createFollowing("doz", "mancu"));
        $this->assertTrue($this->db->createFollowing("doz", "guerrins"));
        $this->assertTrue($this->db->createFollowing("doz", "toscanello"));

        $this->assertFalse($this->db->createFollowing("adam", "adam"));
        $this->assertTrue($this->db->createFollowing("adam", "fede"));
        $this->assertTrue($this->db->createFollowing("adam", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("adam", "chuffo"));
        $this->assertTrue($this->db->createFollowing("adam", "euro"));
        $this->assertTrue($this->db->createFollowing("adam", "frenciu"));
        $this->assertTrue($this->db->createFollowing("adam", "doz"));
        $this->assertTrue($this->db->createFollowing("adam", "valent"));
        $this->assertTrue($this->db->createFollowing("adam", "lhollo"));
        $this->assertTrue($this->db->createFollowing("adam", "mancu"));
        $this->assertTrue($this->db->createFollowing("adam", "guerrins"));
        $this->assertTrue($this->db->createFollowing("adam", "toscanello"));

        $this->assertFalse($this->db->createFollowing("lhollo", "lhollo"));
        $this->assertTrue($this->db->createFollowing("lhollo", "fede"));
        $this->assertTrue($this->db->createFollowing("lhollo", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("lhollo", "chuffo"));
        $this->assertTrue($this->db->createFollowing("lhollo", "euro"));
        $this->assertTrue($this->db->createFollowing("lhollo", "frenciu"));
        $this->assertTrue($this->db->createFollowing("lhollo", "doz"));
        $this->assertTrue($this->db->createFollowing("lhollo", "adam"));
        $this->assertTrue($this->db->createFollowing("lhollo", "valent"));
        $this->assertTrue($this->db->createFollowing("lhollo", "mancu"));
        $this->assertTrue($this->db->createFollowing("lhollo", "guerrins"));
        $this->assertTrue($this->db->createFollowing("lhollo", "toscanello"));

        $this->assertFalse($this->db->createFollowing("mancu", "mancu"));
        $this->assertTrue($this->db->createFollowing("mancu", "fede"));
        $this->assertTrue($this->db->createFollowing("mancu", "valent"));

        $this->assertFalse($this->db->createFollowing("guerrins", "guerrins"));
        $this->assertTrue($this->db->createFollowing("guerrins", "fede"));
        $this->assertTrue($this->db->createFollowing("guerrins", "val_orosa"));
        $this->assertTrue($this->db->createFollowing("guerrins", "valent"));
        $this->assertTrue($this->db->createFollowing("guerrins", "toscanello"));

        $this->assertFalse($this->db->createFollowing("toscanello", "toscanello"));
        $this->assertTrue($this->db->createFollowing("toscanello", "fede"));
        $this->assertTrue($this->db->createFollowing("toscanello", "valent"));


    }

    public function testPosts()
    {
        $this->assertTrue($this->db->createPost($this->content, "valent", array(), $this->location));
        $this->assertTrue($this->db->createPost($this->content, "fede", array(), "Ravenna"));
        $this->assertTrue($this->db->createPost($this->content, "val_orosa", array(), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "chuffo", array(), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "euro", array(), $this->location));
        $this->assertTrue($this->db->createPost($this->content, "valent", array(), $this->location));
        $this->assertTrue($this->db->createPost($this->content, "fede", array(), "Ravenna"));
        $this->assertTrue($this->db->createPost($this->content, "val_orosa", array(), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "chuffo", array(), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "euro", array(), "Bologna"));
    }


}