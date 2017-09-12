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
        '/charts', function (ServerRequestInterface $request) use ($app) {
                    $view = $app->service('view.renderer');
                    $repository = $app->service('category-cost.repository');
                    $auth = $app->service('auth');
                    $data = $request->getQueryParams();

                    $dateStart = $data['date_start'] ?? 
                            (new \DateTime())->modify('-1 month');
                    $dateStart = $dateStart instanceof \DateTime ? 
                            $dateStart->format('Y-m-d') : 
                        \DateTime::createFromFormat(
                            'd/m/Y', 
                            $dateStart
                        )->format('Y-m-d');

                    $dateEnd = $data['date_end'] ?? new \DateTime();
                    $dateEnd = $dateEnd instanceof \DateTime ? 
                            $dateEnd->format('Y-m-d') : 
                        \DateTime::createFromFormat(
                            'd/m/Y', 
                            $dateEnd
                        )->format('Y-m-d');

                    $categories = $repository->sumByPeriod(
                        $dateStart, 
                        $dateEnd, 
                        $auth->user()->getId()
                    );

                    return $view->render(
                        'charts.html.twig', [
                        'categories' => $categories
                            ]
                    );
        }, 'charts.list'
    );
