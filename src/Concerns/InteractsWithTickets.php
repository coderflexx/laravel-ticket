<?php

namespace Coderflex\LaravelTicket\Concerns;

use Coderflex\LaravelTicket\Enums\Priority;
use Coderflex\LaravelTicket\Enums\Status;
use Illuminate\Database\Eloquent\Model;

trait InteractsWithTickets
{
    /**
     * Archive the ticket
     */
    public function archive(): self
    {
        $this->update([
            'status' => Status::ARCHIVED->value,
        ]);

        return $this;
    }

    /**
     * Close the ticket
     */
    public function close(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
        ]);

        return $this;
    }

    /**
     * Reopen the ticket
     */
    public function reopen(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
        ]);

        return $this;
    }

    /**
     * Determine if the ticket is archived
     */
    public function isArchived(): bool
    {
        return $this->status == Status::ARCHIVED->value;
    }

    /**
     * Determine if the ticket is open
     */
    public function isOpen(): bool
    {
        return $this->status == Status::OPEN->value;
    }

    /**
     * Determine if the ticket is closed
     */
    public function isClosed(): bool
    {
        return !$this->isOpen();
    }

    /**
     * Determine if the ticket is resolved
     */
    public function isResolved(): bool
    {
        return $this->is_resolved;
    }

    /**
     * Determine if the ticket is unresolved
     */
    public function isUnresolved(): bool
    {
        return !$this->isResolved();
    }

    /**
     * Determine if the ticket is locked
     */
    public function isLocked(): bool
    {
        return $this->is_locked;
    }

    /**
     * Determine if the ticket is unresolved
     */
    public function isUnlocked(): bool
    {
        return !$this->isLocked();
    }

    /**
     * Mark the ticket as resolved
     */
    public function markAsResolved(): self
    {
        $this->update([
            'is_resolved' => true,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as locked
     */
    public function markAsLocked(): self
    {
        $this->update([
            'is_locked' => true,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as locked
     */
    public function markAsUnlocked(): self
    {
        $this->update([
            'is_locked' => false,
        ]);

        return $this;
    }

    /**
     * Mark the ticket as archived
     */
    public function markAsArchived(): self
    {
        $this->archive();

        return $this;
    }

    /**
     * Close the ticket and mark it as resolved
     */
    public function closeAsResolved(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => true,
        ]);

        return $this;
    }

    /**
     * Close the ticket and mark it as unresolved
     */
    public function closeAsUnresolved(): self
    {
        $this->update([
            'status' => Status::CLOSED->value,
            'is_resolved' => false,
        ]);

        return $this;
    }

    /**
     * Reopen the ticket and mark it as resolved
     */
    public function reopenAsUnresolved(): self
    {
        $this->update([
            'status' => Status::OPEN->value,
            'is_resolved' => false,
        ]);

        return $this;
    }

    /**
     * Add new message on an existing ticket as a custom user
     */
    public function assignTo(Model|int $user): self
    {

        if ($user instanceof Model) {
            $id = $user->getKey();
        }else{
            $id = $user;
        }

        $this->update([
            'assigned_to' => $id,
        ]);

        return $this;
    }

    /**
     * make ticket priority as low
     */
    public function makePriorityAsLow(): self
    {
        $this->update(['priority' => Priority::LOW->value]);

        return $this;
    }

    /**
     * make ticket priority as normal
     */
    public function makePriorityAsNormal(): self
    {
        $this->update(['priority' => Priority::NORMAL->value]);

        return $this;
    }

    /**
     * make ticket priority as high
     */
    public function makePriorityAsHigh(): self
    {
        $this->update(['priority' => Priority::HIGH->value]);

        return $this;
    }
}
