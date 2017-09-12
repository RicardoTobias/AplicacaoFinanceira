<?php
/**
 * In this file, we are defining all the necessary information, 
 * for connection to database.
 * 
 * PHP version 7.1
 *
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Heroku Application
 */

exec(__DIR__ . '/vendor/bin/phinx.bat rollback');
exec(__DIR__ . '/vendor/bin/phinx.bat migrate');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s UsersSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s CategoryCostsSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s BillReceivesSeeder');
exec(__DIR__ . '/vendor/bin/phinx.bat seed:run -s BillPaysSeeder');


