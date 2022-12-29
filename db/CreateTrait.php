<?php
/**
 * Create a new item in DB.
 */
trait CreateTrait
{
    /** Add a user to DB.
     * @param string $id user id (username)
     * @param string $name username (his normal name, not his username)
     * @param string $email account email
     * @param string $password account password
     * @param string $picture_path path to user picture (saved outside DB)
     */
    public function createUser($id, $name, $email, $password, $picture_path)
    {
        if ($this->checkUserIDAvailability($id)) {
            $query = "INSERT INTO users (user_id, user_name, user_email, user_password, user_picture_path, user_bio, account_active_status, num_posts, num_followers, num_following) 
                      VALUES (?, ?, ?, ?, ?, '', '1', 0, 0, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $id, $name, $email, $password, $picture_path);
            $stmt->execute();
        }
    }

    /**
     * Add a comment to DB.
     * @param mixed $content text of comment
     * @param mixed $user
     * @param mixed $post
     * @return void
     */
    public function createComment($content, $user, $post)
    {
        $query = "INSERT INTO comments (comment_id, content, comment_time, user_id, post_id) 
                  VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $this->getNextCommentID(), $content, $user, $post);
        $stmt->execute();
    }
}