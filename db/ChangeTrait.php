<?php
/**
 * Change any item property in DB.
 * Increment/decrement counters.
 */
trait ChangeTrait
{
    /**
     * Change ID of a user.
     * @param string $old_id old ID
     * @param string $new_id new ID
     */
    public function changeUserID($old_id, $new_id)
    {
        if ($this->checkUserIDAvailability($old_id)) {
            $query = "UPDATE users 
                  SET user_id = ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new_id, $old_id);
            $stmt->execute();
        }
    }

    /**
     * Change name of a user.
     * @param string $id user ID
     * @param string $name user name
     */
    public function changeUserName($id, $name)
    {
        $query = "UPDATE users 
                  SET user_name = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $name, $id);
        $stmt->execute();
    }

    /**
     * Change email of a user.
     * @param string $id user ID
     * @param string $email user email
     */
    public function changeUserEmail($id, $email)
    {
        $query = "UPDATE users 
                  SET user_email = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $id);
        $stmt->execute();
    }

    /**
     * Change password of a user.
     * @param string $id user id
     * @param string $old_password old password
     * @param string $new_password new password
     */
    public function changeUserPassword($id, $old_password, $new_password)
    {
        if ($this->findUserPassword($id) === $old_password) {
            $query = "UPDATE users 
                      SET user_password = ? 
                      WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new_password, $id);
            $stmt->execute();
        }
    }

    /**
     * Change profile picture of a user.
     * @param string $id user id
     * @param string $picture_path path of user profile picture
     */
    public function changeUserPicture($id, $picture_path)
    {
        $query = "UPDATE users 
                  SET user_picture_path = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $picture_path, $id);
        $stmt->execute();
    }

    /**
     * Change bio of a user.
     * @param string $id user id
     * @param string $bio user bio
     */
    public function changeUserBio($id, $bio)
    {
        $query = "UPDATE users 
                  SET user_bio = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $bio, $id);
        $stmt->execute();
    }

    /**
     * Change number of posts of a user.
     * @param string $id user id
     * @param int $increment 1 to increment, -1 to decrement
     */
    private function changeNumPosts($id, $increment)
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_posts = num_posts + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $id);
            $stmt->execute();
        }
    }

    /**
     * Increment number of posts of a user.
     * @param string $id user id
     */
    public function incNumPosts($id)
    {
        $this->changeNumPosts($id, 1);
    }

    /**
     * Decrement number of posts of a user.
     * @param string $id user id
     */
    public function decNumPosts($id)
    {
        $this->changeNumPosts($id, -1);
    }

    /**
     * Change number of followers of a user.
     * @param string $id user id
     * @param int $increment 1 to increment, -1 to decrement
     */
    private function changeNumFollowers($id, $increment)
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_followers = num_followers + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $id);
            $stmt->execute();
        }
    }

    /**
     * Increment number of followers of a user.
     * @param string $id user id
     */
    public function incNumFollowers($id)
    {
        $this->changeNumFollowers($id, 1);
    }

    /**
     * Decrement number of followers of a user.
     * @param string $id user id
     */
    public function decNumFollowers($id)
    {
        $this->changeNumFollowers($id, -1);
    }

    /**
     * Change number of following of a user.
     * @param string $id user id
     * @param int $increment 1 to increment, -1 to decrement
     */
    private function changeNumFollowing($id, $increment)
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_following = num_following + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $id);
            $stmt->execute();
        }
    }

    /**
     * Increment number of following of a user.
     * @param string $id user id
     */
    public function incNumFollowing($id)
    {
        $this->changeNumFollowing($id, 1);
    }

    /**
     * Decrement number of following of a user.
     * @param string $id user id
     */
    public function decNumFollowing($id)
    {
        $this->changeNumFollowing($id, -1);
    }
}
