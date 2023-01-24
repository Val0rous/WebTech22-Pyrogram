<?php
/**
 * Delete any item in DB.
 */
trait DeleteTrait
{
    /**
     * Delete user and remove all of its data from DB.
     * @param string $id user id
     * @return bool true if user deleted properly, false otherwise
     */
    public function deleteUser(string $id): bool
    {
        $this->deleteAllNotifications($id); //remove all notifications of/from this user
        $this->deleteAllComments($id);      //delete all comments of/from this user
        $this->deleteAllLikes($id);         //remove all likes of/from this user
        //TODO: delete all stories from this user
        $this->deleteAllTags($id);          //delete all tags of/from this user
        $this->deleteAllFollowings($id);    //remove all following/follower links
        $this->deleteAllPosts($id);         //delete all posts from this user
        //TODO: delete all messages/replies of/from this user (maybe leave them, IDK)
        $query = "DELETE FROM users 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $id);
        return $stmt->execute();
    }

    /**
     * Delete a comment from DB.
     * @param string $comment comment id
     * @return bool true if comment deleted, false otherwise
     */
    public function deleteComment(string $comment): bool
    {
        $post = $this->findComment($comment)["post_id"];
        $query = "DELETE FROM comments 
                  WHERE comment_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $comment);
        $result = $stmt->execute();
        if ($result) {
            $this->decNumComments($post);
        }
        return $result;
    }

    /**
     * Delete all comments of a user from DB.
     * ONLY USE in deleteUser()
     * @param string $user user id
     * @return bool true if all comments deleted, false otherwise
     */
    private function deleteAllComments(string $user): bool
    {
        //select all comments of a user
        $query = "SELECT post_id 
                  FROM comments 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of comments for each post
        foreach ($comments as $comment) {
            $this->decNumComments($comment["post_id"]);
        }
        //delete all comments of a user
        $query = "DELETE FROM comments 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute();
    }

    /**
     * Delete a post from DB.
     * @param string $post post id
     * @return bool true if post deleted, false otherwise
     */
    public function deletePost(string $post): bool
    {
        $user = $this->findPost($post)["user_id"];
        $query = "DELETE FROM posts 
                  WHERE post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $post);
        $result = $stmt->execute();
        if ($result) {
            $this->decNumPosts($user);
        }
        return $result;
    }

    /** Delete all posts of a user from DB.
     * ONLY USE in deleteUser()
     * @param string $user user id
     * @return bool true if all posts deleted, false otherwise
     */
    private function deleteAllPosts(string $user): bool
    {
        //select all tags of all user posts
        $query = "SELECT * 
                  FROM tags 
                  WHERE post_id IN (SELECT * 
                                    FROM posts 
                                    WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $tags = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of tags for each post
        foreach ($tags as $tag) {
            $this->decNumTags($tag["post_id"]);
        }
        //delete all tags of a user
        $query = "DELETE FROM tags 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();

        //select all comments of all user posts
        $query = "SELECT * 
                  FROM comments 
                  WHERE post_id IN (SELECT * 
                                    FROM posts 
                                    WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $comments = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of comments of post
        foreach ($comments as $comment) {
            $this->decNumComments($comment["post_id"]);
        }
        //delete all comments of all user posts
        $query = "DELETE FROM comments 
                  WHERE post_id IN (SELECT * 
                                    FROM posts 
                                    WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();

        //select all likes of all user posts
        $query = "SELECT * 
                  FROM likes 
                  WHERE post_id IN (SELECT * 
                                    FROM posts 
                                    WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $likes = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of likes of post
        foreach ($likes as $like) {
            $this->decNumLikes($like["post_id"]);
        }
        //delete all likes of all user posts
        $query = "DELETE FROM likes 
                  WHERE post_id IN (SELECT * 
                                    FROM posts 
                                    WHERE user_id = ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();

        //select all posts of a user
        $query = "SELECT * 
                  FROM posts 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of posts of user
        foreach ($posts as $post) {
            $this->decNumPosts($user);
        }
        //delete all user posts
        $query = "DELETE FROM posts 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute();
    }

    /**
     * Delete a following from DB.
     * @param string $user_following user who follows another one
     * @param string $user_followed user who is followed by another one
     * @return bool true if follow deleted, false otherwise
     */
    public function deleteFollowing(string $user_following, string $user_followed): bool
    {
        $query = "DELETE FROM followings 
                  WHERE user_id_following = ? 
                  AND user_id_followed = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user_following, $user_followed);
        $result = $stmt->execute();
        if ($result) {
            $this->decNumFollowing($user_following);
            $this->decNumFollowers($user_followed);
        }
        return $result;
    }

    /**
     * Delete all followings/followers of user from DB.
     * ONLY USE in deleteUser()
     * @param string $user user id
     * @return bool true if all followings/followers deleted, false otherwise
     */
    private function deleteAllFollowings(string $user): bool
    {
        //select all followings of a user
        $query = "SELECT user_id_followed 
                  FROM followings 
                  WHERE user_id_following = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $followings = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of followings of user
        foreach ($followings as $following) {
            $this->decNumFollowing($user);
            $this->decNumFollowers($following["user_id_followed"]);
        }
        //delete all followings
        $query = "DELETE FROM followings 
                  WHERE user_id_following = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $return_value = $stmt->execute();

        //select all followers of a user
        $query = "SELECT user_id_following 
                  FROM followings 
                  WHERE user_id_followed = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $followers = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of followers of user
        foreach ($followers as $follower) {
            $this->decNumFollowers($user);
            $this->decNumFollowing($follower["user_id_following"]);
        }
        //delete all followers
        $query = "DELETE FROM followings 
                  WHERE user_id_followed = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute() && $return_value;
    }

    /**
     * Delete a like from DB.
     * @param string $user user id
     * @param string $post post id
     * @return bool true if like deleted, false otherwise
     */
    public function deleteLike(string $user, string $post): bool
    {
        $query = "DELETE FROM likes 
                  WHERE user_id = ? 
                  AND post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user, $post);
        $result = $stmt->execute();
        if ($result) {
            $this->decNumLikes($post);
        }
        return $result;
    }

    /**
     * Delete all likes of a user from DB.
     * ONLY USE in deleteUser()
     * @param string $user user id
     * @return bool true if all liked deleted, false otherwise
     */
    private function deleteAllLikes(string $user): bool
    {
        //select all likes of a user
        $query = "SELECT * 
                  FROM likes 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $likes = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of likes for each post
        foreach ($likes as $like) {
            $this->decNumLikes($like["post_id"]);
        }
        //delete all likes of a user
        $query = "DELETE FROM likes 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute();
    }

    /**
     * Delete a notification from DB.
     * @param string $notification notification id
     * @return bool true if notification deleted, false otherwise
     */
    public function deleteNotification(string $notification): bool
    {
        $query = "DELETE FROM notifications 
                  WHERE notification_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $notification);
        return $stmt->execute();
    }

    /**
     * Delete all notifications received or sent by a user from DB.
     * @param string $user user id
     * @return bool true if all notifications deleted, false otherwise
     */
    private function deleteAllNotifications(string $user): bool
    {
        $query = "DELETE FROM notifications 
                  WHERE user_id = ? 
                  OR sender_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute();
    }

    /**
     * Delete a tag from DB.
     * @param string $user user id
     * @param string $post post id
     * @return bool true if tag deleted, false otherwise
     */
    public function deleteTag(string $user, string $post): bool
    {
        $query = "DELETE FROM tags 
                  WHERE user_id = ? 
                  AND post_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user, $post);
        return $stmt->execute();
    }

    /**
     * Delete all tags of a user from DB.
     * @param string $user user id
     * @return bool true if all tags deleted, false otherwise
     */
    private function deleteAllTags(string $user): bool
    {
        //select all posts where user is tagged
        $query = "SELECT post_id 
                  FROM tags 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $result = $stmt->get_result();
        $tags = $result->fetch_all(MYSQLI_ASSOC);
        //decrease number of tags for each post
        foreach ($tags as $tag) {
            $this->decNumTags($tag["post_id"]);
        }
        //delete all tags of a user
        $query = "DELETE FROM tags 
                  WHERE user_id = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("s", $user);
        return $stmt->execute();
    }
}
