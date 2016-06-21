<?php

return array(
    "paths" => array(
        "migrations" => "%%PHINX_CONFIG_DIR%%/src/test/php/db/migrations"
    ),

    "environments" => array(
        "default_migration_tableg" => "dym_phinxlog",
        "default_database" => "testing",

        "testing" => array(
            "adapter" => "mysql",
            "host" => "localhost",
            "name" => "dym_testing_db",
            "user" => "root",
            "pass" => '',
            "port" => 3306,
            "charset" => "utf8"
        )
    )
);