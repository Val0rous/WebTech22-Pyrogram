<?php
/**
 * Search and find any item in DB.
 */
trait SearchTrait
{
    /**
     * Find a user in database.
     * @param string $id user id
     * @return array query result
     */
    public function findUser($id)
    {
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
                  FROM users 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Incrementally search for a user in database, including all partial matches.
     * A partial match is a string having the same id specified as argument plus any prefix or suffix.
     * ONLY USE in search box
     * DO NOT USE in any queries
     * @param string $search_string search string
     * @return array associative array containing all matches
     */
    public function searchUser($search_string)
    {
        $search_string = strtolower($search_string);
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
                  FROM users 
                  WHERE user_id LIKE ? 
                  OR LOWER(user_name) LIKE ? 
                  AND account_active_status = '1' 
                  ORDER BY LENGTH(SUBSTRING_INDEX(user_id, ?, 1)) ASC, LENGTH(SUBSTRING_INDEX(LOWER(user_name), ?, 1)) ASC";
        $stmt = $this->db->prepare($query);
        $formatted_search_string = "%" . $search_string . "%";
        $stmt->bind_param("ssss", $formatted_search_string, $formatted_search_string, $search_string, $search_string);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
        /*
        // creating array
        $array = [];
        while ($row = $result->fetch_assoc()) {
            static $index = 0;
            $array[$index] = $row;
            $index++;
        }
        return $array;
        */
    }

    /**
     * Find password of a user in database.
     * @param string $id user id
     * @return string user password
     */
    private function findUserPassword($id)
    {
        $query = "SELECT user_password 
                  FROM users 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC)["user_password"];
    }

    /**
     * Find comment by ID in database.
     * @param string $comment comment ID
     * @return array query result 
     */
    public function findComment($comment)
    {
        $query = "SELECT * 
                  FROM comments 
                  WHERE comment_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $comment);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Find all comments of a post in database
     * @param string $post post ID
     * @return array query result
     */
    public function findAllComments($post)
    {
        $query = "SELECT * 
                  FROM comments 
                  WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQL_ASSOC);
    }

    public function findPost($post)
    {
        
    }
}
