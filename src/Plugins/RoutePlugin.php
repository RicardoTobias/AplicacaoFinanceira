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
declare(strict_types = 1);

namespace SONFin\Plugins;

use Aura\Router\RouterContainer;
use SONFin\ServiceContainerInterface;
use Interop\Container\ContainerInterface;
use Psr\Http\Message\RequestInterface;
use Zend\Diactoros\ServerRequestFactory;
/**
 * Jasny Class extends AuthInterface
 * 
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Financial Application
 */
class RoutePlugin implements PluginInterface
{

    /**
     * JasnyAuth constructor.
     * 
     * @param object $container Respository Interface
     * 
     * @access public
     * 
     * @return objetc
     */
    public function register(ServiceContainerInterface $container) 
    {

        $routerContainer = new RouterContainer();
        
        /* Registrar as rotas da aplicação */
        $map = $routerContainer->getMap();
        
        /* Tem a função de identificar a rota que está sendo acessada */
        $matcher = $routerContainer->getMatcher();
        
        /* Tem a função de gerar links com base nas rotas registradas */
        $generator = $routerContainer->getGenerator();
        
        $request = $this->getRequest();

        $container->add('routing', $map);
        $container->add('routing.matcher', $matcher);
        $container->add('routing.generator', $generator);
        $container->add(RequestInterface::class, $request);

        $container->addLazy(
            'route', function (ContainerInterface $container) {
                $matcher = $container->get('routing.matcher');
                $request = $container->get(RequestInterface::class);
                return $matcher->match($request);
            }
        );
    }

    /**
     * JasnyAuth constructor.
     * 
     * @access protected
     * 
     * @return objetc
     */
    protected function getRequest(): RequestInterface 
    {
        return ServerRequestFactory::fromGlobals(
            $_SERVER, 
            $_GET, 
            $_POST, 
            $_COOKIE, 
            $_FILES
        );
    }

}
