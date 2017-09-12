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

use SONFin\Application;
use SONFin\Plugins\AuthPlugin;
use SONFin\Plugins\DbPlugin;
use SONFin\ServiceContainer;

$serviceContainer = new ServiceContainer();
$app = new Application($serviceContainer);

$app->plugin(new DbPlugin());
$app->plugin(new AuthPlugin());

return $app;
