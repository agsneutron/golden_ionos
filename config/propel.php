<?php
return [
    'propel' => [
        'database' => [
            'connections' => [
                'golden_clean' => [
                    'adapter' => 'mysql',
                    'dsn' => 'mysql:host=127.0.0.1;dbname=goldenti_db',
                    'user' => 'goldenti_user',
                    'password' => 'VTH7tJ5K',
                    'settings' => [
                        'charset' => 'utf8'
                    ]
                ]
            ]
        ],
        'runtime' => [
            'defaultConnection' => 'golden_clean',
            'connections' => ['golden_clean']
        ],
        'generator' => [
            'defaultConnection' => 'golden_clean',
            'connections' => ['golden_clean'],
            'schemaDir' => __DIR__ . '/database',   // <-- aquí está tu schema.xml
            'outputDir' => __DIR__ . '/generated-classes', // carpeta donde se generarán los modelos
            'dateTime' => [
                'defaultTimeStampFormat' =>'Y-m-d H:i:s',
                'defaultTimeFormat' => 'H:i:s',
                'defaultDateFormat' => 'Y-m-d'
            ]
        ]
    ]
];
?>