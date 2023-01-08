<?php
/**
 * Main actions that will be performed on website.
 */
trait ActionTrait
{
    /**
     * Activate user account.
     * @param string $id user id
     * @return void
     */
    public function activateUser(string $id): void
    {
        $this->setUserActivityStatus($id, true);
    }

    /**
     * Deactivate user account.
     * @param mixed $id user id
     * @return void
     */
    public function deactivateUser(string $id): void
    {
        $this->setUserActivityStatus($id, false);
    }

    /**
     * Fetch all posts published by all users followed by current user.
     * @param string $user user id
     * @return array list of posts to be shown in feed, or an empty array if there are no posts to be shown
     */
    public function fetchPosts(string $user): array
    {
        $followings = $this->findAllFollowings($user)["user_id"];
        $posts = array();
        foreach ($followings as $following) {
            //$posts = array_merge($posts, $this->findAllPosts($following));    //old way
            array_push($posts, ...$this->findAllPosts($following));      //new way
        }
        if (count($posts) > 0) {
            //sorting by descending date
            return $this->quick_sort($posts, "post_time", true);
        } else {
            //empty array
            return array();
        }
    }

    /**
     * Sort a numerical array of associative arrays (aka the array of posts returned by a query) based on the specified
     * key, either in ascending or descending order, depending on the value of the related parameter.
     * @param array $array array to sort
     * @param string $key key on which to sort the array
     * @param bool $desc_order false -> ascending (default), true -> descending
     * @return array sorted array
     */
    public function quick_sort(array $array, string $key, bool $desc_order = false): array
    {
        if (count($array) < 2) {
            return $array;
        }
        $left = $right = array();
        $pivot_key = key($array);
        $pivot = array_shift($array);
        foreach ($array as $index => $item) {
            if ($desc_order === true) {
                // descending
                if ($item[$key] > $pivot[$key]) {
                    $left[$index] = $item;
                } else {
                    $right[$index] = $item;
                }
            } else {
                // ascending
                if ($item[$key] < $pivot[$key]) {
                    $left[$index] = $item;
                } else {
                    $right[$index] = $item;
                }
            }
        }
        return array_merge($this->quick_sort($left, $key, $desc_order), array($pivot_key=>$pivot), $this->quick_sort($right, $key, $desc_order));
    }

    /*
    public function qsort(array $array): array
    {
        if(count($array) < 2) {
            return $array;
        }

        $left = $right = array();

        $pivot_key = key($array);
        $pivot = array_shift($array);

        foreach($array as $k => $v) {
            // descending
            if($v > $pivot)
                $left[$k] = $v;
            else
                $right[$k] = $v;
        }

        return array_merge($this->qsort($left), array($pivot_key => $pivot), $this->qsort($right));
    }
    */
}
