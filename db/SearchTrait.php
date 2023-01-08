<?php
/**
 * Search and find any item in DB.
 */
trait SearchTrait
{
    /**
     * Find a user in database.
     * @param string $id user id
     * @return array|null query result
     */
    public function findUser(string $id): array|null
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
     * @return array|null associative array containing all matches
     */
    public function searchUser(string $search_string): array|null
    {
        $search_string = strtolower($search_string);
        $query = "SELECT user_id, user_name, user_picture_path, user_bio, num_posts, num_followers, num_following 
                  FROM users 
                  WHERE user_id LIKE ? 
                  OR LOWER(user_name) LIKE ? 
                  AND account_active_status = '1' 
                  ORDER BY LENGTH(SUBSTRING_INDEX(user_id, ?, 1)), LENGTH(SUBSTRING_INDEX(LOWER(user_name), ?, 1))";
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
    private function findUserPassword(string $id): string
    {
        $query = "SELECT user_password 
                  FROM users 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc()["user_password"];
    }

    /**
     * Find comment by ID in database.
     * @param string $comment comment ID
     * @return array query result 
     */
    public function findComment(string $comment): array
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
     * Find all comments of a post in database.
     * @param string $post post ID
     * @return array query result
     */
    public function findAllComments(string $post): array
    {
        $query = "SELECT * 
                  FROM comments 
                  WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Find a post in database.
     * @param string $post post id
     * @return array query result
     */
    public function findPost(string $post): array
    {
        $query = "SELECT * 
                  FROM posts 
                  WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    /**
     * Find all posts of a user in database.
     * @param string $user user id
     * @return array query result
     */
    public function findAllPosts(string $user): array
    {
        $query = "SELECT * 
                  FROM posts 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Find all followers of a user.
     * @param string $user user id of followed account
     * @return array query result
     */
    public function findAllFollowers(string $user): array
    {
        $query = "SELECT u.user_id, u.user_name, u.user_picture_path, u.user_bio, u.num_posts, u.num_followers, u.num_following 
                  FROM users u 
                  JOIN followings f 
                  ON u.user_id = f.user_id_following 
                  WHERE f.user_id_followed = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Find all followings of a user.
     * @param string $user user id of following account
     * @return array query result
     */
    public function findAllFollowings(string $user): array
    {
        $query = "SELECT u.user_id, u.user_name, u.user_picture_path, u.user_bio, u.num_posts, u.num_followers, u.num_following 
                  FROM users u 
                  JOIN followings f 
                  ON u.user_id = f.user_id_followed 
                  WHERE f.user_id_following = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
