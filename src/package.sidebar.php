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
                'name'  => 'Operations',
                'icon'  => 'fa-space-shuttle',
                'route' => 'operation.index',
                'permission' => 'calendar.view'
            ],
            [
                'name'  => 'Settings',
                'icon'  => 'fa-cog',
                'route' => 'setting.index',
                'permission' => 'calendar.setup'
            ]
        ]
    ]
];
