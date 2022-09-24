<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Tables Names
    |--------------------------------------------------------------------------
    |
    | You can change the table names depends on your application structure
    | the value in the below tables, is the current table name, and if
    | are happy with it, leave it as it is.
    |
    */
    'table_names' => [
        'tickets' => 'tickets',
        'categories' => 'categories',
        'labels' => 'labels',
        'messages' => 'messages',
        'label_ticket' => [
            'table' => 'label_ticket',
            'columns' => [
                'label_foreign_id' => 'label_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
        'category_ticket' => [
            'table' => 'category_ticket',
            'columns' => [
                'category_foreign_id' => 'category_id',
                'ticket_foreign_id' => 'ticket_id',
            ],
        ],
    ],

];
