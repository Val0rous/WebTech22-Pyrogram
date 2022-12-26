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
     * @param string $id user id (username)
     * @param string $name user name (his normal name, not his username)
     * @param string $email account email
     * @param string $password account password
     * @param string $picture_path path to user picture (saved outside DB)
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
     * @param string $id user id
     * @return mixed query result
     */
    public function exactSearchUser($id)
    {
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
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
     * @param string $id
     * @return array array containing all matches
     */
    public function incrementalSearchUser($id)
    {
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
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
     * Change activity status to a user's account
     * @param string $id user id
     * @param bool $status true to activate, false to deactivate
     */
    public function setUserActivityStatus($id, $status)
    {
        if ($status === true) {
            // activate
            $flag = "1";
        } else {
            // deactivate
            $flag = "0";
        }
        $query = "UPDATE users 
                  SET account_active_status = '?' 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $flag, $id);
        $stmt->execute();
    }

    /**
     * Check if a given user account is active.
     * @param string $id user id to check
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
     * @param string $id user ID to check
     * @return bool true if user ID is available, false if user ID is not available
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

    ////create user
    //delete user
    ////activate user
    ////deactivate user
    ////search user incrementally
    ////search user exactly (get user)
    ////check user account activity status
    ////check availability of a user id
    //change user id
    //change user name
    //change user email
    //change user password
    //change user picture path
    //change user bio
    //increment/decrement num posts
    //increment/decrement num followers
    //increment/decrement num following

    //get comment
    //create comment on post
    //delete comment
    //edit comment (???) (IDK, maybe comments should be made not editable)

    //get followings
    //get followers
    //add follower/following
    //remove follower/following

    //get likes
    //add like to post
    //remove like

    //get messages
    //create message
    //delete message

    //get notifications
    //post notification
    //delete notification

    //get post(s)
    //create post
    //delete post
    //edit post (???) (Optional but I believe it should be a feature)

    //get replies
    //create reply to story
    //delete reply

    //get stories
    //create story
    //delete story

    //get tags
    //add tag to post
    //remove tag
}
