<?php
return [
    'timeZone' => date_default_timezone_get(),
    'components' => [
        'formatter' => [
            'dateFormat' => 'd.MM.yyyy',
            'timeFormat' => 'H:mm:ss',
            'datetimeFormat' => 'd.MM.yyyy H:mm',
        ],
    ],
];
