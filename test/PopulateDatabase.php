<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "../db/DatabaseHelper.php";
use PHPUnit\Framework\TestCase;

final class PopulateDatabase extends TestCase
{
    private DatabaseHelper $db;
    private bool $db_created = false;
    private string $profile_pic = "default_profile_pic.jpg";
    private string $content = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse in purus tincidunt metus placerat ultrices. Curabitur eu convallis neque, quis rhoncus metus. Suspendisse id neque dui. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum ante urna, sodales at ultricies ut, tincidunt quis velit. In sed orci ut enim tempor consequat. Fusce magna libero, venenatis id ante nec, convallis aliquet turpis. Etiam ut felis sit amet ligula tincidunt dignissim a vitae nisi. Curabitur ornare nisi vitae tempor vehicula. Sed nisl ipsum, vulputate quis libero vel, aliquam dictum lacus. Vestibulum porta malesuada est et molestie. Pellentesque nec diam mauris. Proin condimentum sem leo, id aliquam ex semper at.";
    private array $images = array("db/media/posts/grand_canyon.jpg", "db/media/posts/mars.jpg",
                            "db/media/posts/jupiter.webp", "db/media/posts/fireworks.jpeg", 
                            "db/media/posts/shrek.png");

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
        $this->assertTrue($this->db->findUser("SARAROSSI.SR") || $this->db->createUser("SARAROSSI.SR", "Sara Rossi", "sararossi@gmail.com", "password", $this->profile_pic));   //testing whether uppercase strings get converted to lowercase
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
        $this->assertTrue($this->db->findFollowing("fede", "valent") || $this->db->createFollowing("fede", "valent"));
        $this->assertTrue($this->db->findFollowing("fede", "val_orosa") || $this->db->createFollowing("fede", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("fede", "chuffo") || $this->db->createFollowing("fede", "chuffo"));
        $this->assertTrue($this->db->findFollowing("fede", "euro") || $this->db->createFollowing("fede", "euro"));
        $this->assertTrue($this->db->findFollowing("fede", "frenciu") || $this->db->createFollowing("fede", "frenciu"));
        $this->assertTrue($this->db->findFollowing("fede", "doz") || $this->db->createFollowing("fede", "doz"));
        $this->assertTrue($this->db->findFollowing("fede", "adam") || $this->db->createFollowing("fede", "adam"));
        $this->assertTrue($this->db->findFollowing("fede", "lhollo") || $this->db->createFollowing("fede", "lhollo"));
        $this->assertTrue($this->db->findFollowing("fede", "mancu") || $this->db->createFollowing("fede", "mancu"));
        $this->assertTrue($this->db->findFollowing("fede", "guerrins") || $this->db->createFollowing("fede", "guerrins"));
        $this->assertTrue($this->db->findFollowing("fede", "toscanello") || $this->db->createFollowing("fede", "toscanello"));

        $this->assertFalse($this->db->createFollowing("val_orosa", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("val_orosa", "fede") || $this->db->createFollowing("val_orosa", "fede"));
        $this->assertTrue($this->db->findFollowing("val_orosa", "valent") || $this->db->createFollowing("val_orosa", "valent"));
        $this->assertTrue($this->db->findFollowing("val_orosa", "chuffo") || $this->db->createFollowing("val_orosa", "chuffo"));

        $this->assertFalse($this->db->createFollowing("chuffo", "chuffo"));
        $this->assertTrue($this->db->findFollowing("chuffo", "fede") || $this->db->createFollowing("chuffo", "fede"));
        $this->assertTrue($this->db->findFollowing("chuffo", "val_orosa") || $this->db->createFollowing("chuffo", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("chuffo", "valent") || $this->db->createFollowing("chuffo", "valent"));
        $this->assertTrue($this->db->findFollowing("chuffo", "euro") || $this->db->createFollowing("chuffo", "euro"));
        $this->assertTrue($this->db->findFollowing("chuffo", "frenciu") || $this->db->createFollowing("chuffo", "frenciu"));
        $this->assertTrue($this->db->findFollowing("chuffo", "doz") || $this->db->createFollowing("chuffo", "doz"));
        $this->assertTrue($this->db->findFollowing("chuffo", "adam") || $this->db->createFollowing("chuffo", "adam"));

        $this->assertFalse($this->db->createFollowing("euro", "euro"));
        $this->assertTrue($this->db->findFollowing("euro", "fede") || $this->db->createFollowing("euro", "fede"));
        $this->assertTrue($this->db->findFollowing("euro", "val_orosa") || $this->db->createFollowing("euro", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("euro", "chuffo") || $this->db->createFollowing("euro", "chuffo"));
        $this->assertTrue($this->db->findFollowing("euro", "valent") || $this->db->createFollowing("euro", "valent"));
        $this->assertTrue($this->db->findFollowing("euro", "frenciu") || $this->db->createFollowing("euro", "frenciu"));

        $this->assertFalse($this->db->createFollowing("frenciu", "frenciu"));
        $this->assertTrue($this->db->findFollowing("frenciu", "fede") || $this->db->createFollowing("frenciu", "fede"));
        $this->assertTrue($this->db->findFollowing("frenciu", "val_orosa") || $this->db->createFollowing("frenciu", "val_orosa"));
        $this->assertTrue($this->db->findFollowing("frenciu", "chuffo") || $this->db->createFollowing("frenciu", "chuffo"));
        $this->assertTrue($this->db->findFollowing("frenciu", "euro") || $this->db->createFollowing("frenciu", "euro"));
        $this->assertTrue($this->db->findFollowing("frenciu", "valent") || $this->db->createFollowing("frenciu", "valent"));

        $this->assertFalse($this->db->createFollowing("doz", "doz"));
        $this->assertTrue($this->db->findFollowing("doz", "fede") || $this->db->createFollowing("doz", "fede"));
        $this->assertTrue($this->db->findFollowing("doz", "valent") || $this->db->createFollowing("doz", "valent"));
        $this->assertTrue($this->db->findFollowing("doz", "adam") || $this->db->createFollowing("doz", "adam"));
        $this->assertTrue($this->db->findFollowing("doz", "lhollo") || $this->db->createFollowing("doz", "lhollo"));

        $this->assertFalse($this->db->createFollowing("adam", "adam"));
        $this->assertTrue($this->db->findFollowing("adam", "fede") || $this->db->createFollowing("adam", "fede"));
        $this->assertTrue($this->db->findFollowing("adam", "euro") || $this->db->createFollowing("adam", "euro"));
        $this->assertTrue($this->db->findFollowing("adam", "doz") || $this->db->createFollowing("adam", "doz"));
        $this->assertTrue($this->db->findFollowing("adam", "valent") || $this->db->createFollowing("adam", "valent"));

        $this->assertFalse($this->db->createFollowing("lhollo", "lhollo"));
        $this->assertTrue($this->db->findFollowing("lhollo", "fede") || $this->db->createFollowing("lhollo", "fede"));
        $this->assertTrue($this->db->findFollowing("lhollo", "euro") || $this->db->createFollowing("lhollo", "euro"));
        $this->assertTrue($this->db->findFollowing("lhollo", "valent") || $this->db->createFollowing("lhollo", "valent"));
        $this->assertTrue($this->db->findFollowing("lhollo", "mancu") || $this->db->createFollowing("lhollo", "mancu"));

        $this->assertFalse($this->db->createFollowing("mancu", "mancu"));
        $this->assertTrue($this->db->findFollowing("mancu", "fede") || $this->db->createFollowing("mancu", "fede"));
        $this->assertTrue($this->db->findFollowing("mancu", "valent") || $this->db->createFollowing("mancu", "valent"));

        $this->assertFalse($this->db->createFollowing("guerrins", "guerrins"));
        $this->assertTrue($this->db->findFollowing("guerrins", "fede") || $this->db->createFollowing("guerrins", "fede"));
        $this->assertTrue($this->db->findFollowing("guerrins", "valent") || $this->db->createFollowing("guerrins", "valent"));

        $this->assertFalse($this->db->createFollowing("toscanello", "toscanello"));
        $this->assertTrue($this->db->findFollowing("toscanello", "fede") || $this->db->createFollowing("toscanello", "fede"));
        $this->assertTrue($this->db->findFollowing("toscanello", "valent") || $this->db->createFollowing("toscanello", "valent"));
    }

    public function testPosts()
    {
        $this->assertTrue($this->db->createPost($this->content, "valent", array("db/media/posts/grand_canyon.jpg"), "Forlì"));
        $this->assertTrue($this->db->createPost($this->content, "fede", array("db/media/posts/mars.jpg"), "Ravenna"));
        $this->assertTrue($this->db->createPost($this->content, "val_orosa", array("db/media/posts/jupiter.webp"), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "chuffo", array("db/media/posts/fireworks.jpeg"), "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "euro", array("db/media/posts/shrek.png"), "Forlì"));
        $this->assertTrue($this->db->createPost($this->content, "valent", $this->images, "Forlì"));
        $this->assertTrue($this->db->createPost($this->content, "fede", $this->images, "Ravenna"));
        $this->assertTrue($this->db->createPost($this->content, "val_orosa", $this->images, "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "chuffo", $this->images, "Milano"));
        $this->assertTrue($this->db->createPost($this->content, "euro", $this->images, "Bologna"));
    }

    public function testLikes()
    {
        //these post ids are valid for me because I have quite a lot of posts created for debug purposes
        //we'll need to change them later on
        $this->assertTrue($this->db->findLike("val_orosa", "0000000000000034") || $this->db->createLike("val_orosa", "0000000000000034"));
        $this->assertTrue($this->db->findLike("val_orosa", "0000000000000035") || $this->db->createLike("val_orosa", "0000000000000035"));
        //more to add...
    }

    public function testComments()
    {
        //these post ids are valid for me because I have quite a lot of posts created for debug purposes
        //we'll need to change them later on
        $this->assertTrue(($this->db->findComment("0000000000000001") !== null) || $this->db->createComment($this->content, "val_orosa", "0000000000000034"));
        $this->assertTrue(($this->db->findComment("0000000000000002") !== null) || $this->db->createComment($this->content, "val_orosa", "0000000000000035"));
    }
}