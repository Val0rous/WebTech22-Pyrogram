<?php
trait SearchTrait
{
    /**
     * Search for a user in database.
     * @param string $id user id
     * @return mixed query result
     */
    public function findUser($id)
    {
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
                  FROM users 
                  WHERE user_id = '?'";
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
     * ONLY USE in search box
     * DO NOT USE in any queries
     * @param string $id
     * @return array array containing all matches
     */
    public function searchUser($id)
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
}