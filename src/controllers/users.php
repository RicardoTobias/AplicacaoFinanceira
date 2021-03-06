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
        '/users', function () use ($app) {
                $view = $app->service('view.renderer');
                $repository = $app->service('user.repository');
                $users = $repository->all();
                return $view->render(
                    'users/list.html.twig', [
                        'users' => $users
                    ]
                );
        }, 'users.list'
    )
        ->get(
            '/users/new', function () use ($app) {
                $view = $app->service('view.renderer');
                return $view->render('users/create.html.twig');
            }, 'users.new'
        )
            ->post(
                '/users/store', 
                function (ServerRequestInterface $request) use ($app) {
                        $data = $request->getParsedBody();
                        $repository = $app->service('user.repository');
                        $auth = $app->service('auth');
                        $data['password'] = $auth->hashPassword($data['password']);
                        $repository->create($data);
                        return $app->redirect('/users');
                }, 'users.store'
            )
        ->get(
            '/users/{id}/edit', 
            function (ServerRequestInterface $request) use ($app) {
                    $view = $app->service('view.renderer');
                    $id = $request->getAttribute('id');
                    $repository = $app->service('user.repository');
                    $user = $repository->find($id);
                    return $view->render(
                        'users/edit.html.twig', [
                        'user' => $user
                        ]
                    );
            }, 'users.edit'
        )
            ->post(
                '/users/{id}/update', 
                function (ServerRequestInterface $request) use ($app) {
                        $repository = $app->service('user.repository');
                        $id = $request->getAttribute('id');
                        $data = $request->getParsedBody();
                    if (isset($data['password'])) {
                        unset($data['password']);
                    }
                        $repository->update($id, $data);
                        return $app->route('users.list');
                }, 'users.update'
            )
        ->get(
            '/users/{id}/show', 
            function (ServerRequestInterface $request) use ($app) {
                    $view = $app->service('view.renderer');
                    $id = $request->getAttribute('id');
                    $repository = $app->service('user.repository');
                    $user = $repository->find($id);
                    return $view->render(
                        'users/show.html.twig', [
                        'user' => $user
                        ]
                    );
            }, 'users.show'
        )
        ->get(
            '/users/{id}/delete', 
            function (ServerRequestInterface $request) use ($app) {
                    $repository = $app->service('user.repository');
                    $id = $request->getAttribute('id');
                    $repository->delete($id);
                    return $app->route('users.list');
            }, 'users.delete'
        );

