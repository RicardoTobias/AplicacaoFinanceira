<?php

exec(__DIR__ . '/vendor/bin/phinx.bat rollback');
exec(__DIR__ . '/vendor/bin/phinx.bat migrate');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s UsersSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s CategoryCostsSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s BillReceivesSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s BillPaysSeeder');


