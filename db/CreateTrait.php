<?php
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
                      VALUES ('?', '?', '?', '?', '?', '', '1', 0, 0, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $id, $name, $email, $password, $picture_path);
            $stmt->execute();
        }
    }
}