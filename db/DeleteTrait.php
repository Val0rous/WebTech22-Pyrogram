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

    /**
     * Delete a post from DB.
     * @param $post post id
     * @return void
     */
    public function deletePost($post)
    {
        $user = $this->findPost($post)["user_id"];
        $query = "DELETE FROM posts 
                  WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $post);
        $stmt->execute();
        $this->decNumPosts($user);
    }

    /**
     * Delete a following from DB.
     * @param $user_following user who follows another one
     * @param $user_followed user who is followed by another one
     * @return void
     */
    public function deleteFollowing($user_following, $user_followed)
    {
        $query = "DELETE FROM followings 
                  WHERE user_id_following = ? 
                  AND user_id_followed = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user_following, $user_followed);
        $stmt->execute();
        $this->decNumFollowing($user_following);
        $this->decNumFollowers($user_followed);
    }
}
