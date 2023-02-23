<?php

namespace Coderflex\LaravelTicket\Concerns;

use Illuminate\Database\Eloquent\Model;

trait InteractsWithTicketRelations
{
    /**
     * Associate Labels into an existing ticket
     *
     * @param  mixed  $id
     * @param  bool  $touch
     * @return void
     */
    public function attachLabels($id, array $attributes = [], $touch = true)
    {
        $this->labels()->attach($id, $attributes, $touch);
    }

    /**
     * Sync the intermediate tables with a list of IDs or collection of the ticket model..
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model|array  $ids
     * @param  bool  $detaching
     * @return array
     */
    public function syncLabels($ids, $detaching = true)
    {
        return $this->labels()->sync($ids, $detaching);
    }

    /**
     * Associate Categories into an existing ticket
     *
     * @param  mixed  $id
     * @param  bool  $touch
     * @return void
     */
    public function attachCategories($id, array $attributes = [], $touch = true)
    {
        $this->categories()->attach($id, $attributes, $touch);
    }

    /**
     * Sync the intermediate tables with a list of IDs or collection of the ticket model..
     *
     * @param  \Illuminate\Support\Collection|\Illuminate\Database\Eloquent\Model|array  $ids
     * @param  bool  $detaching
     * @return array
     */
    public function syncCategories($ids, $detaching = true)
    {
        return $this->categories()->sync($ids, $detaching);
    }

    /**
     * Add new message on an existing ticket
     */
    public function message(string $message): Model
    {
        return $this->messageAsUser(auth()->user(), $message);
    }

    /**
     * Add new message on an existing ticket as a custom user
     */
    public function messageAsUser(?Model $user, string $message): Model
    {
        return $this->messages()->create([
            'user_id' => $user?->id ?? auth()->id(), // @phpstan-ignore-line
            'message' => $message,
        ]);
    }
}
