<?php
trait DeleteTrait
{
    public function deleteUser($id)
    {
        //TODO: remove all notifications of/from this user
        //TODO: delete all comments of/from this user
        //TODO: delete all stories from this user
        //TODO: delete all tags of/from this user
        //TODO: remove all following/follower links
        //TODO: remove all likes of/from this user
        //TODO: delete all posts from this user
        //TODO: delete all messages of/from this user (maybe leave them, IDK)
        $query = "DELETE FROM users 
                  WHERE user_id = '?'";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }
}