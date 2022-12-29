<?php
trait ChangeTrait
{
    /**
     * Change ID of a user
     * @param string $old_id old ID
     * @param string $new_id new ID
     */
    public function changeUserID($old_id, $new_id)
    {
        if ($this->checkUserIDAvailability($old_id)) {
            $query = "UPDATE users 
                  SET user_id = '?' 
                  WHERE user_id = '?'";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $new_id, $old_id);
            $stmt->execute();
        }
    }

    /**
     * Change name of a user
     * @param string $id user ID
     * @param string $name user name
     */
    public function changeUserName($id, $name)
    {
        $query = "UPDATE users 
                  SET user_name = '?' 
                  WHERE user_id = '?'";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $name, $id);
            $stmt->execute();
    }

    /**
     * Change email of a user
     * @param string $id user ID
     * @param string $email user email
     */
    public function changeUserEmail($id, $email)
    {
        $query = "UPDATE users 
                  SET user_email = '?' 
                  WHERE user_id = '?'";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("ss", $email, $id);
            $stmt->execute();
    }
}