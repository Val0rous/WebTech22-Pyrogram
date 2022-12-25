<?php
class DatabaseHelper
{
    private $db;

    public function __construct($servername, $username, $password, $dbname, $port)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    /** Adds a user to DB.
     * @param $id user id (username)
     * @param $name user name (his normal name, not his username)
     * @param $email account email
     * @param $password account password
     * @param $picture_path path to user picture (saved outside DB)
     * @return true if user has been added
     * @return false if user could not be added - a user with the same ID already exists
     */
    public function addUser($id, $name, $email, $password, $picture_path)
    {
        if ($this->checkUserIDAvailability($id)) {
            $query = "INSERT INTO users (user_id, user_name, user_email, user_password, user_picture_path, user_bio, num_posts, num_followers, num_following) 
            VALUES (?, ?, ?, ?, ?, NULL, 0, 0, 0, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $id, $name, $email, $password, $picture_path);
            $stmt->execute();
            return true;
        } else {
            // user id already exists
            return false;
        }
    }

    /** Checks if a given user ID is available.
     * @return true if user ID is available
     * @return false if user ID is not available
    */
    private function checkUserIDAvailability($id)
    {
        $query = "SELECT user_id FROM users WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        if ($result->num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }
}