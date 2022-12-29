<?php
class DatabaseHelper
{
    use CreateTrait;
    use SearchTrait;
    use ChangeTrait;
    use ActionTrait;
    use DeleteTrait;

    private $db;

    /**
     * Open connection to database.
     * @param string $servername name of server where DB is hosted
     * @param string $username username
     * @param string $password password
     * @param string $dbname name of database
     * @param int $port MySQL port
     */
    public function __construct($servername = "localhost", $username = "", $password = "", $dbname = "pyrogram", $port = 3306)
    {
        $this->db = new mysqli($servername, $username, $password, $dbname, $port);
        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }
    }

    /**
     * Close connection to database.
     */
    public function __destruct()
    {
        $this->db->close();
    }

    /**
     * Change activity status to a user's account
     * @param string $id user id
     * @param bool $status true to activate, false to deactivate
     */
    private function setUserActivityStatus($id, $status)
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

    /** Check if a given user ID is available.
     * @param string $id user ID to check
     * @return bool true if user ID is available, false if user ID is not available
     */
    public function checkUserIDAvailability($id)
    {
        if ($this->isQueryResultEmpty($this->findUser($id))) {
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
    private function isQueryResultEmpty($query_result)
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
    ////change user id
    ////change user name
    ////change user email
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
    //edit post (???) (Optional, but I believe it should be a feature)

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
