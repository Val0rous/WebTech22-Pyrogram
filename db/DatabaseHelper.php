<?php
require_once("CreateTrait.php");
require_once("SearchTrait.php");
require_once("ChangeTrait.php");
require_once("ActionTrait.php");
require_once("DeleteTrait.php");

/**
 * Handle database connection and queries.
 */
class DatabaseHelper
{
    use CreateTrait;
    use SearchTrait;
    use ChangeTrait;
    use ActionTrait;
    use DeleteTrait;

    private mysqli $db;

    /**
     * Open connection to database.
     * @param string $servername name of server where DB is hosted (use 127.0.0.1 instead of localhost or it may not work)
     * @param string $username username
     * @param string $password password
     * @param string $dbname name of database
     * @param int $port MySQL port
     */
    public function __construct(string $servername = "127.0.0.1", string $username = "root", string $password = "", string $dbname = "pyrogram", int $port = 3306)
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
                  SET account_active_status = ? 
                  WHERE user_id = ?";
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
                  WHERE user_id = ?";
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
        if ($query_result === null) {
            // empty
            return true;
        } else {
            // not empty
            return false;
        }
    }

    /**
     * Get first available comment ID.
     * @return string first available comment ID
     */
    private function getNextCommentID(): string
    {
        $query = "SELECT comment_id 
                  FROM comments 
                  ORDER BY comment_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "comment_id");
    }

    /**
     * Get first available message ID.
     * @return string first available message ID.
     */
    private function getNextMessageID()
    {
        $query = "SELECT message_id 
                  FROM messages 
                  ORDER BY message_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "message_id");
    }

    /**
     * Get first available notification ID.
     * @return string first available notification ID
     */
    private function getNextNotificationID()
    {
        $query = "SELECT notification_id 
                  FROM notifications 
                  ORDER BY notification_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "notification_id");
    }

    /**
     * Get first available post ID.
     * @return string first available post ID
     */
    private function getNextPostID()
    {
        $query = "SELECT post_id 
                  FROM posts 
                  ORDER BY post_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "post_id");
    }

    /**
     * Get first available reply ID.
     * @return string first available reply ID
     */
    private function getNextReplyID()
    {
        $query = "SELECT reply_id 
                  FROM replies 
                  ORDER BY reply_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "reply_id");
    }
    
    /**
     * Get first available story ID.
     * @return string first available story ID
     */
    private function getNextStoryID()
    {
        $query = "SELECT story_id 
                  FROM stories 
                  ORDER BY story_id ASC";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        return $this->getFirstAvailableID($result, "story_id");
    }

    /**
     * Get first available ID in a query result.
     * @param mixed $list list of IDs as table rows, gathered from a query result
     * @param mixed $id name of the ID column
     * @return string first available ID
     */
    private function getFirstAvailableID($list, $id)
    {
        if ($this->isQueryResultEmpty($list)) {
            // no comments
            return $this->padString(strval(0));
        } else {
            // run through list to find first available comment ID
            $num_rows = $list->fetch_all(MYSQLI_ASSOC);
            $index = 0;
            while ($index < $list->num_rows) {
                if (intval($list->fetch_assoc()[$id]) > $index) {
                    return $this->padString(strval($index));
                }
                $index++;
            }
            return $this->padString(strval($index));
        }
    }

    /**
     * Format string as ID.
     * @param string $string string to pad
     * @return string padded string
     */
    private function padString($string)
    {
        return str_pad($string, 16, "0", STR_PAD_LEFT);
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
    ////change user password
    ////change user picture path
    ////change user bio
    ////increment/decrement num posts
    ////increment/decrement num followers
    ////increment/decrement num following

    //get comment
    //create comment on post
    ////delete comment
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
