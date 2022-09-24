<?php

namespace Coderflex\LaravelTicket\Concerns;

trait InteractsWithTicketRelations
{
    /**
     * Associate Labels into an existing ticket
     *
     * @param  mixed  $id
     * @param  array  $attributes
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
}
