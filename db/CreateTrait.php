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
     * Add a post to DB.
     * @param string $content text of post
     * @param string $user user id
     * @param array $media_path_array list of media paths (if any)
     */
    public function createPost($content, $user, $media_path_array = null)
    {
        $size = count($media_path_array);
        if ($size <= 10) {
            // fill array with null values if there are less than 10 image paths
            for ($i = 0; $i < 10; $i++) {
                if ($i >= $size) {
                    $media_path_array[$i] = null;
                }
            }
            $query = "INSERT INTO posts (post_id, content, media_path0, media_path1, media_path2, media_path3, media_path4, media_path5, media_path6, media_path7, media_path8, media_path9, post_time, num_likes, num_comments, num_tags, user_id) 
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), 0, 0, 0, ?)";
            $stmt = $this->db->prepare($query);
            $next_post_id = $this->getNextPostID();
            $stmt->bind_param("sssssssssssss", $next_post_id, $content,
                    $media_path_array[0], $media_path_array[1], $media_path_array[2],
                    $media_path_array[3], $media_path_array[4], $media_path_array[5],
                    $media_path_array[6], $media_path_array[7], $media_path_array[8],
                    $media_path_array[9], $user);
            $stmt->execute();
            $this->incNumPosts($user);
        }
    }

    /**
     * Add a comment to DB.
     * @param mixed $content text of comment
     * @param mixed $user user id
     * @param mixed $post post id
     */
    public function createComment($content, $user, $post)
    {
        $query = "INSERT INTO comments (comment_id, content, comment_time, user_id, post_id) 
                  VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $next_comment_id = $this->getNextCommentID();
        $stmt->bind_param("ssss", $next_comment_id, $content, $user, $post);
        $stmt->execute();
    }

    /**
     * Add a following to DB.
     * @param $user_following user who follows another one
     * @param $user_followed user who is followed by another one
     * @return void
     */
    public function createFollowing($user_following, $user_followed)
    {
        $query = "INSERT INTO followings (user_id_following, user_id_followed) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user_following, $user_followed);
        $stmt->execute();
        $this->incNumFollowing($user_following);
        $this->incNumFollowers($user_followed);
    }
}
