<?php
/**
 * Main actions that will be performed on website.
 */
trait ActionTrait
{
    /**
     * Activate user account.
     * @param string $id user id
     */
    public function activateUser($id)
    {
        $this->setUserActivityStatus($id, true);
    }

    /**
     * Deactivate user account.
     * @param mixed $id user id
     */
    public function deactivateUser($id)
    {
        $this->setUserActivityStatus($id, false);
    }
}