<?php
declare(strict_types=1);

use Coderflex\LaravelTicket\Models\Category;
use Coderflex\LaravelTicket\Models\Label;
use Coderflex\LaravelTicket\Models\Message;
use Coderflex\LaravelTicket\Models\Ticket;

return [
    /*
    |--------------------------------------------------------------------------
    | Tables Names
    |--------------------------------------------------------------------------
    |
    | You can change the table names depends on your application structure
    | the values in the below tables, is the current table name, and if
    | are happy with it, leave it as it is, if not. You may read the related
    | instruction before you change the values.
    |
    */
    'models' => [
        'ticket' => Ticket::class,
        'message' => Message::class,
        'category' => Category::class,
        'labels' => Label::class
    ],

    'table_names' => [
        /**
         * Tickets table
         */
        'tickets' => 'tickets',
        /**
         * Categories table for the tickets
         */
        'categories' => 'ticket_categories',
        /**
         * Labels table for the tickets
         */
        'labels' => 'ticket_labels',
        /**
         * Messages table to appear in the ticket
         */
        'messages' => [
            'table' => 'ticket_messages',
            /**
             * This is the foreing key for associated to the ticket
             * If you renamed the ticket table, you should consider
             * changing this column as well to follow the laravel
             * convention, "table_id"
             *
             * @see https://laravel.com/docs/9.x/eloquent-relationships#one-to-many
             */
            'columns' => [
                'user_foreing_id' => 'user_id',
                'ticket_foreing_id' => 'ticket_id',
            ],
        ],
        /**
         * Many to Many relationship between the tickets table
         * and the labels table, if you changed the one of the
         * tables above, you may consider change the columns
         * below.
         *
         * @see https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
         */
        'label_ticket' => [
            'table' => 'ticket_label',
            'columns' => [
                'label_foreign_id' => 'label_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
        /**
         * Many to Many relationship between the tickets table
         * and the categories table, the above description, applies
         * to this also
         *
         * @see https://laravel.com/docs/9.x/eloquent-relationships#many-to-many
         */
        'category_ticket' => [
            'table' => 'ticket_category',
            'columns' => [
                'category_foreign_id' => 'category_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
    ],

];
