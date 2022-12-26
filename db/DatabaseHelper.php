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

    /** Add a user to DB.
     * @param $id user id (username)
     * @param $name user name (his normal name, not his username)
     * @param $email account email
     * @param $password account password
     * @param $picture_path path to user picture (saved outside DB)
     */
    public function addUser($id, $name, $email, $password, $picture_path)
    {
        if ($this->checkUserIDAvailability($id)) {
            $query = "INSERT INTO users (user_id, user_name, user_email, user_password, user_picture_path, user_bio, account_active_status, num_posts, num_followers, num_following) 
                      VALUES ('?', '?', '?', '?', '?', '', '1', 0, 0, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $id, $name, $email, $password, $picture_path);
            $stmt->execute();
        }
    }

    /**
     * Search for a user in database.
     * @param mixed $id user id
     * @return mixed user id if exists, "not found" if it does not exist
     */
    public function exactSearchUser($id)
    {
        $query = "SELECT user_id 
                  FROM users 
                  WHERE user_id = '?'
                  AND account_active_status = '1'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        return $result;
    }

    /**
     * Incrementally search for a user in database, including all partial matches.
     * A partial match is a string having the same id specified as argument plus any prefix or suffix.
     * @param mixed $id
     * @return array array containing all matches
     */
    public function incrementalSearchUser($id)
    {
        $query = "SELECT user_id 
                  FROM users 
                  WHERE user_id LIKE '%?%' 
                  AND account_active_status = '1' 
                  ORDER BY LENGTH(SUBSTRING_INDEX(user_id, '?', 1))";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $id, $id);
        $stmt->execute();
        $stmt->bind_result($row);
        // creating array
        $array = [];
        while ($stmt->fetch()) {
            static $index = 0;
            $array[$index] = $row;
            $index++;
        }
        return $array;
    }

    /**
     * Deactivate a user's account.
     * @param mixed $id
     * @return void
     */
    public function deactivateUser($id)
    {
        $query = "UPDATE users 
                  SET account_active_status = '0' 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /**
     * Activate a user's account.
     * @param mixed $id
     * @return void
     */
    public function activateUser($id)
    {
        $query = "UPDATE users 
                  SET account_active_status = '1' 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /**
     * Check if a given user account is active.
     * @param mixed $id user id to check
     * @return bool true if user is active, false if it is inactive
     */
    public function isUserActive($id)
    {
        $query = "SELECT account_active_status 
                  FROM users 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $stmt->bind_result($result);
        $stmt->fetch();
        if ($result === '1') {
            return true;
        } else {
            return false;
        }
    }

    public function deleteUser($id)
    {
        //TODO: remove all notifications of/from this user
        //TODO: delete all comments of/from this user
        //TODO: delete all stories from this user
        //TODO: delete all tags of/from this user
        //TODO: remove all following/follower links
        //TODO: remove all likes of/from this user
        //TODO: delete all posts from this user
        //TODO: delete all messages of/from this user (maybe leave them, IDK)
        $query = "DELETE FROM users 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /** Check if a given user ID is available.
     * @param mixed $id user ID to check
     * @return bool true if user ID is available
     * @return bool false if user ID is not available
     */
    public function checkUserIDAvailability($id)
    {
        if ($this->isQueryResultEmpty($this->exactSearchUser($id))) {
            // available
            return true;
        } else {
            // not available
            return false;
        }
    }

    /**
     * Check if a query result is empty (contains no rows).
     * @param mixed $query_result the query result to be checked
     * @return bool true if empty, false if not empty
     */
    public function isQueryResultEmpty($query_result)
    {
        if ($query_result->num_rows === 0) {
            // empty
            return true;
        } else {
            // not empty
            return false;
        }
    }
}
