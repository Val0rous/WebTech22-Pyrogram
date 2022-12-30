<?php
/**
 * Delete any item in DB.
 */
trait DeleteTrait
{
    /**
     * Delete user and remove all of its data from DB.
     * @param string $id user id
     */
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
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
    }

    /**
     * Delete a comment from DB.
     * @param string $comment comment id
     */
    public function deleteComment($comment)
    {
        $query = "DELETE FROM comments 
                  WHERE comment_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $comment);
        $stmt->execute();
    }

    /**
     * Delete all comments of a user from DB.
     * ONLY USE in deleteUser()
     * @param string $user user id
     */
    private function deleteAllComments($user)
    {
        $query = "DELETE FROM comments 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
    }
}