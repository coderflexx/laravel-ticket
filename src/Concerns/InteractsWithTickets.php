<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Status;

trait InteractsWithTickets
{
    /**
     * Archive the ticket
     *
     * @return bool
     */
    public function archive(): bool
    {
        return $this->update([
            'status' => Status::ARCHIVED->value,
        ]);
    }

    /**
     * Close the ticket
     *
     * @return bool
     */
    public function close(): bool
    {
        return $this->update([
            'status' => Status::CLOSED->value,
        ]);
    }

    /**
     * Reopen the ticket
     *
     * @return bool
     */
    public function reopen(): bool
    {
        return $this->update([
            'status' => Status::OPEN->value,
        ]);
    }

    /**
     * Determine if the ticket is archived
     *
     * @return bool
     */
    public function isArchived(): bool
    {
        return $this->status == Status::ARCHIVED->value;
    }

    /**
     * Determine if the ticket is open
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return $this->status == Status::OPEN->value;
    }

    /**
     * Determine if the ticket is closed
     *
     * @return bool
     */
    public function isClosed(): bool
    {
        return ! $this->isOpen();
    }

    /**
     * Determine if the ticket is resolved
     *
     * @return bool
     */
    public function isResolved(): bool
    {
        return $this->is_resolved;
    }

    /**
     * Determine if the ticket is unresolved
     *
     * @return bool
     */
    public function isUnresolved(): bool
    {
        return ! $this->isResolved();
    }

    /**
     * Determine if the ticket is locked
     *
     * @return bool
     */
    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Determine if the ticket is unresolved
     *
     * @return bool
     */
    public function isUnlocked(): bool
    {
        return ! $this->isLocked();
    }

    /**
     * Delete the ticket
     *
     * @return bool
     */
    public function delete(): bool
    {
        return $this->delete();
    }

    /**
     * Mark the ticket as resolved
     *
     * @return bool
     */
    public function markAsResolved(): bool
    {
        return $this->update([
            'is_resolved' => true,
        ]);
    }

    /**
     * Mark the ticket as locked
     *
     * @return bool
     */
    public function markAsLocked(): bool
    {
        return $this->update([
            'is_locked' => true,
        ]);
    }

    /**
     * Mark the ticket as locked
     *
     * @return bool
     */
    public function markAsUnlocked(): bool
    {
        return $this->update([
            'is_locked' => false,
        ]);
    }

    /**
     * Mark the ticket as archived
     *
     * @return bool
     */
    public function markAsArchived(): bool
    {
        return $this->update([
            'status' => Status::ARCHIVED->value,
        ]);
    }

    /**
     * Close the ticket and mark it as resolved
     *
     * @return bool
     */
    public function closeAsResolved(): bool
    {
        return $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => true,
        ]);
    }

    /**
     * Close the ticket and mark it as unresolved
     *
     * @return bool
     */
    public function closeAsUnResolved(): bool
    {
        return $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => false,
        ]);
    }

    /**
     * Reopen the ticket and mark it as resolved
     *
     * @return bool
     */
    public function reopenAsUnresolved(): bool
    {
        return $this->update([
            'status' => Status::OPEN->value,
            'is_resolved' => false,
        ]);
    }
}
