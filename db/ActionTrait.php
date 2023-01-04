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
}