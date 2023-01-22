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
     * @return bool true if user has been created
     */
    public function createUser(string $id, string $name, string $email, string $password, string $picture_path): bool
    {
        if ($this->checkUserIDAvailability($id)) {
            $query = "INSERT INTO users (user_id, user_name, user_email, user_password, user_picture_path, user_bio, account_active_status, num_posts, num_followers, num_following) 
                      VALUES (?, ?, ?, ?, ?, '', '1', 0, 0, 0)";
            $stmt = $this->db->prepare($query);
            $stmt->bind_param("sssss", $id, $name, $email, $password, $picture_path);
            return $stmt->execute();
        } else {
            return false;
        }
    }

    /**
     * Add a post to DB.
     * @param string $content text of post
     * @param string $user user id
     * @param array|null $media_path_array list of media paths (if any)
     * @param string|null $location user-specified location (city, coordinates, or any other arbitrary string)
     * @return bool true if post created, false otherwise
     */
    public function createPost(string $content, string $user, array $media_path_array = null, string $location = null): bool
    {
        if ($media_path_array !== null) {
            $size = count($media_path_array);
        } else {
            $size = 0;
            $media_path_array = array();
        }
        if ($size <= 10) {
            // fill array with null values if there are less than 10 image paths
            for ($i = 0; $i < 10; $i++) {
                if ($i >= $size) {
                    $media_path_array[$i] = null;
                }
            }
            $query = "INSERT INTO posts (post_id, content, media_path0, media_path1, media_path2, media_path3, media_path4, media_path5, media_path6, media_path7, media_path8, media_path9, location, post_time, num_likes, num_comments, num_tags, user_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0, 0, 0, ?)";
            $stmt = $this->db->prepare($query);
            $next_post_id = $this->getNextPostID();
            $stmt->bind_param("ssssssssssssss", $next_post_id, $content,
                    $media_path_array[0], $media_path_array[1], $media_path_array[2],
                    $media_path_array[3], $media_path_array[4], $media_path_array[5],
                    $media_path_array[6], $media_path_array[7], $media_path_array[8],
                    $media_path_array[9], $location, $user);
            $result = $stmt->execute();
            if ($result) {
                $this->incNumPosts($user);
            }
            return $result;
        }
        return false;
    }

    /**
     * Add a comment to DB.
     * @param string $content text of comment
     * @param string $user user id
     * @param string $post post id
     * @return bool true if comment created, false otherwise
     */
    public function createComment(string $content, string $user, string $post): bool
    {
        $query = "INSERT INTO comments (comment_id, content, comment_time, user_id, post_id) 
                  VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $next_comment_id = $this->getNextCommentID();
        $stmt->bind_param("ssss", $next_comment_id, $content, $user, $post);
        $result = $stmt->execute();
        if ($result) {
            $this->incNumComments($post);
            $this->createNotification("<span>" . $user . "</span> commented on a post you shared.", "c", $this->findPost($post)["user_id"]);
        }
        return $result;
    }

    /**
     * Add a following to DB.
     * @param string $user_following user who follows another one
     * @param string $user_followed user who is followed by another one
     * @return bool true if follow created, false otherwise
     */
    public function createFollowing(string $user_following, string $user_followed): bool
    {
        if ($user_following === $user_followed) {
            return false;
        }
        $query = "INSERT INTO followings (user_id_following, user_id_followed) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user_following, $user_followed);
        $result = $stmt->execute();
        if ($result) {
            $this->incNumFollowing($user_following);
            $this->incNumFollowers($user_followed);
            $this->createNotification("<span>" . $user_following . "</span> started following you.", "f", $user_followed, $user_following);
        }
        return $result;
    }

    /**
     * Add a like to DB.
     * @param string $user
     * @param string $post
     * @return bool true if like created, false otherwise
     */
    public function createLike(string $user, string $post): bool
    {
        $query = "INSERT INTO likes (user_id, post_id) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user, $post);
        $result = $stmt->execute();
        if ($result) {
            $this->incNumLikes($post);
            $this->createNotification("<span>" . $user . "</span> liked your post.", "l", $this->findPost($post)["user_id"]);
        }
        return $result;
    }

    /**
     * Add a notification to DB.
     * @param string $content notification content
     * @param string $type notification type, single character: <br>
     *                      "c": comment, <br>
     *                      "f": follow, <br>
     *                      "l": like, <br>
     *                      "m": message, <br>
     *                      "p": post, <br>
     *                      "r": reply (to a story), <br>
     *                      "s": story, <br>
     *                      "t": tag
     * @param string $user user id
     * @param string|null $follower follower id
     * @param string|null $post post id     //experimental, may be scrapped
     * @param string|null $story story id   //experimental, may be scrapped
     * @return bool true if notification created, false otherwise
     */
    public function createNotification(string $content, string $type, string $user, string $follower = null, string $post = null, string $story = null): bool
    {
        $query = "INSERT INTO notifications (notification_id, content, notification_type, notification_time, read_status, user_id, follower_id, post_id, story_id) 
                  VALUES (?, ?, ?, NOW(), '0', ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $next_notification_id = $this->getNextNotificationID();
        $stmt->bind_param("sssssss", $next_notification_id, $content, $type, $user, $follower, $post, $story);
        return $stmt->execute();
    }
}
