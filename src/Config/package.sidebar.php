<?php

return [
    'paps' => [
        'name'          => 'paps',
        'label'         => 'paps::seat.plugin_name',
        'icon'          => 'fa-calendar',
        'route_segment' => 'paps',
        'permission' => 'paps.view',
        'entries' => [
            [
                'name'  => 'View',
                'icon'  => 'fa-space-shuttle',
                'route' => 'operation.index',
                'permission' => 'paps.view'
            ]
        ]
    ]
];
