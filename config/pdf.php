<?php

return [
    'mode'                 => '',
    'format'               => 'A4',
    'default_font_size'    => '12',
    'default_font'         => 'amiri',
    'margin_left'          => 10,
    'margin_right'         => 10,
    'margin_top'           => 10,
    'margin_bottom'        => 10,
    'orientation'          => 'P',
    'title'                => 'Laravel PDF',
    'subject'              => '',
    'author'               => '',
    'keywords'             => '',
    'creator'              => 'Laravel Pdf',
    'display_mode'         => 'fullpage',
    'tempDir'              => base_path('storage/app'),
    'custom_font_dir' => resource_path('fonts/'),
    'custom_font_data' => [
        'amiri' => [
            'R' => 'Amiri-Regular.ttf',
            'useOTL' => 0xFF,
            'useKashida' => 75,
        ],
    ],
    'default_font' => 'amiri',
];
