<?php
/**
 * Financial Apllication
 * 
 * PHP version 7.1
 *
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Financial Application
 */

use Psr\Http\Message\ServerRequestInterface;

$app
    ->get(
        '/login', function (ServerRequestInterface $request) use ($app) {
                $view = $app->service('view.renderer');
                return $view->render('auth/login.html.twig');
        }, 'auth.show_login_form'
    )
        ->post(
            '/login', function (ServerRequestInterface $request) use ($app) {
                    $view = $app->service('view.renderer');
                    $auth = $app->service('auth');
                    $data = $request->getParsedBody();
                    $result = $auth->login($data);
                if (!$result) {
                    return $view->render('auth/login.html.twig');
                }
                    return $app->route('category-costs.list');
            }, 'auth.login'
        )
        ->get(
            '/logout', function (ServerRequestInterface $request) use ($app) {
                $app->service('auth')->logout();
                return $app->route('auth.show_login_form');
            }, 'auth.logout'
        );

        
$app->before(
    function () use ($app) {
        $route = $app->service('route');
        $auth = $app->service('auth');
        $routesWhiteList = [
        'auth.show_login_form',
        'auth.login'
        ];
        if (!in_array($route->name, $routesWhiteList) && !$auth->check()) {
            return $app->route('auth.show_login_form');
        }
    }
);
