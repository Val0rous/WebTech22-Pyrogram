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
     * @return void
     */
    public function changeUserID(string $old_id, string $new_id): void
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
     * @param string $user user ID
     * @param string $name user name
     * @return void
     */
    public function changeUserName(string $user, string $name): void
    {
        $query = "UPDATE users 
                  SET user_name = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $name, $user);
        $stmt->execute();
    }

    /**
     * Change email of a user.
     * @param string $user user ID
     * @param string $email user email
     * @return void
     */
    public function changeUserEmail(string $user, string $email): void
    {
        $query = "UPDATE users 
                  SET user_email = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $email, $user);
        $stmt->execute();
    }

    /**
     * Change password of a user.
     * @param string $user user id
     * @param string $old_password old password
     * @param string $new_password new password
     * @return void
     */
    public function changeUserPassword(string $user, string $old_password, string $new_password): void
    {
        if ($this->findUserPassword($user) === $old_password) {
            $query = "UPDATE users 
                      SET user_password = ? 
                      WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new_password, $user);
            $stmt->execute();
        }
    }

    /**
     * Change profile picture of a user.
     * @param string $user user id
     * @param string $picture_path path of user profile picture
     * @return void
     */
    public function changeUserPicture(string $user, string $picture_path): void
    {
        $query = "UPDATE users 
                  SET user_picture_path = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $picture_path, $user);
        $stmt->execute();
    }

    /**
     * Change bio of a user.
     * @param string $user user id
     * @param string $bio user bio
     * @return void
     */
    public function changeUserBio(string $user, string $bio): void
    {
        $query = "UPDATE users 
                  SET user_bio = ? 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $bio, $user);
        $stmt->execute();
    }

    /**
     * Change number of posts of a user.
     * @param string $user user id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumPosts(string $user, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_posts = num_posts + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $user);
            $stmt->execute();
        }
    }

    /**
     * Increment number of posts of a user.
     * @param string $user user id
     * @return void
     */
    public function incNumPosts(string $user): void
    {
        $this->changeNumPosts($user, 1);
    }

    /**
     * Decrement number of posts of a user.
     * @param string $user user id
     * @return void
     */
    public function decNumPosts(string $user): void
    {
        $this->changeNumPosts($user, -1);
    }

    /**
     * Change number of followers of a user.
     * @param string $user user id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumFollowers(string $user, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_followers = num_followers + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $user);
            $stmt->execute();
        }
    }

    /**
     * Increment number of followers of a user.
     * @param string $user user id
     * @return void
     */
    public function incNumFollowers(string $user): void
    {
        $this->changeNumFollowers($user, 1);
    }

    /**
     * Decrement number of followers of a user.
     * @param string $user user id
     * @return void
     */
    public function decNumFollowers(string $user): void
    {
        $this->changeNumFollowers($user, -1);
    }

    /**
     * Change number of following of a user.
     * @param string $user user id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumFollowing(string $user, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE users 
                  SET num_following = num_following + ? 
                  WHERE user_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $user);
            $stmt->execute();
        }
    }

    /**
     * Increment number of following of a user.
     * @param string $user user id
     * @return void
     */
    public function incNumFollowing(string $user): void
    {
        $this->changeNumFollowing($user, 1);
    }

    /**
     * Decrement number of following of a user.
     * @param string $user user id
     * @return void
     */
    public function decNumFollowing(string $user): void
    {
        $this->changeNumFollowing($user, -1);
    }

    /**
     * Change number of likes of a post.
     * @param string $post post id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumLikes(string $post, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE posts 
                      SET num_likes = num_likes + ? 
                      WHERE post_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $post);
            $stmt->execute();
        }
    }

    /**
     * Increment number of likes of a post.
     * @param string $post post id
     * @return void
     */
    public function incNumLikes(string $post): void
    {
        $this->changeNumLikes($post, 1);
    }

    /**
     * Decrement number of likes of a post.
     * @param string $post post id
     * @return void
     */
    public function decNumLikes(string $post): void
    {
        $this->changeNumLikes($post, -1);
    }

    /**
     * Change number of comments of a post.
     * @param string $post post id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumComments(string $post, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE posts 
                      SET num_comments = num_comments + ? 
                      WHERE post_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $post);
            $stmt->execute();
        }
    }

    /**
     * Increment number of comments of a post.
     * @param string $post post id
     * @return void
     */
    public function incNumComments(string $post): void
    {
        $this->changeNumComments($post, 1);
    }

    /**
     * Decrement number of comments of a post.
     * @param string $post post id
     * @return void
     */
    public function decNumComments(string $post): void
    {
        $this->changeNumComments($post, -1);
    }

    /**
     * Change number of tags of a post.
     * @param string $post post id
     * @param int $increment 1 to increment, -1 to decrement
     * @return void
     */
    private function changeNumTags(string $post, int $increment): void
    {
        if ($increment === 1 or $increment === -1) {
            $query = "UPDATE posts 
                      SET num_tags = num_tags + ? 
                      WHERE post_id = ?";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("is", $increment, $post);
            $stmt->execute();
        }
    }

    /**
     * Increment number of tags of a post.
     * @param string $post post id
     * @return void
     */
    public function incNumTags(string $post): void
    {
        $this->changeNumTags($post, 1);
    }

    /**
     * Decrement number of tags of a post.
     * @param string $post post id
     * @return void
     */
    public function decNumTags(string $post): void
    {
        $this->changeNumTags($post, -1);
    }
}
