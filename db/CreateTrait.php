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
     * @return bool
     */
    public function createPost(string $content, string $user, array $media_path_array = null, string $location = null): bool
    {
        $size = count($media_path_array);
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
     * @return void
     */
    public function createComment(string $content, string $user, string $post): void
    {
        $query = "INSERT INTO comments (comment_id, content, comment_time, user_id, post_id) 
                  VALUES (?, ?, NOW(), ?, ?)";
        $stmt = $this->db->prepare($query);
        $next_comment_id = $this->getNextCommentID();
        $stmt->bind_param("ssss", $next_comment_id, $content, $user, $post);
        $stmt->execute();
        $this->incNumComments($post);
    }

    /**
     * Add a following to DB.
     * @param string $user_following user who follows another one
     * @param string $user_followed user who is followed by another one
     * @return void
     */
    public function createFollowing(string $user_following, string $user_followed): void
    {
        $query = "INSERT INTO followings (user_id_following, user_id_followed) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user_following, $user_followed);
        $stmt->execute();
        $this->incNumFollowing($user_following);
        $this->incNumFollowers($user_followed);
    }

    public function createLike(string $user, string $post): void
    {
        $query = "INSERT INTO likes (user_id, post_id) 
                  VALUES (?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $user, $post);
        $stmt->execute();
        $this->incNumLikes($post);
    }
}
