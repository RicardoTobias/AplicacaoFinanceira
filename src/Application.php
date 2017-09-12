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

declare(strict_types = 1);

namespace SONFin;

use SONFin\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\RedirectResponse;

/**
 * Auth Class implementing AuthInterface
 * 
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Financial Application
 */
class Application
{

    /** 
     * Comentário de variáveis
     * Variável recebe o diretório para gravar as fotos. 
     *
     * @access private 
     * @name   $diretorio 
     */ 
    private $_serviceContainer;
    private $_befores = [];

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param object $serviceContainer contain object from ServiceContainer
     * 
     * @access public 
     * 
     * @return object
     */ 
    public function __construct(ServiceContainerInterface $serviceContainer) 
    {
        $this->_serviceContainer = $serviceContainer;
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $name Service name
     * 
     * @access public
     * 
     * @return string 
     */ 
    public function service($name) 
    {
        return $this->_serviceContainer->get($name);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $name    Service name
     * @param String $service Service type
     * 
     * @access public
     * 
     * @return void 
     */ 
    public function addService(string $name, $service): void 
    {
        if (is_callable($service)) {
            $this->_serviceContainer->addLazy($name, $service);
        } else {
            $this->_serviceContainer->add($name, $service);
        }
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $plugin Plugin object after added
     * 
     * @access public 
     * 
     * @return void | object
     */ 
    public function plugin(PluginInterface $plugin): void 
    {
        $plugin->register($this->_serviceContainer);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $path   Directory's path
     * @param String $action Action
     * @param String $name   Name
     
     * @access public 
     * 
     * @return array | object
     */ 
    public function get($path, $action, $name = null): Application 
    {
        $routing = $this->service('routing');
        $routing->get($name, $path, $action);

        return $this;
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $path   Directory's path
     * @param String $action Action
     * @param String $name   Name
     
     * @access public 
     * 
     * @return array | object
     */ 
    public function post($path, $action, $name = null): Application 
    {
        $routing = $this->service('routing');
        $routing->post($name, $path, $action);

        return $this;
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $path Directory's path
     *
     * @access public 
     * 
     * @return object
     */ 
    public function redirect($path) 
    {
        return new RedirectResponse($path);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $name   Directory's path
     * @param Array  $params Params
     
     * @access public 
     * 
     * @return array | string
     */ 
    public function route(string $name, array $params = []) 
    {
        $generator = $this->service('routing.generator');
        $path = $generator->generate($name, $params);
        return $this->redirect($path);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $callback Directory's path
     *
     * @access public 
     * 
     * @return array | object
     */ 
    public function before(callable $callback): Application 
    {
        array_push($this->_befores, $callback);
        return $this;
    }

    /** 
     * Função para  gravar imagem em diretório
     *   
     * @access public 
     * 
     * @return array | object
     */  
    protected function runBefores(): ?ResponseInterface 
    {
        foreach ($this->_befores as $callback) {
            $result = $callback($this->service(RequestInterface::class));
            if ($result instanceof ResponseInterface) {
                return $result;
            }
        }
        return null;
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public
     * @return array | void
     */ 
    public function start(): void 
    {
        $route = $this->service('route');
        $request = $this->service(RequestInterface::class);
        if (!$route) {
            echo "Page not found";
            exit;
        }
        foreach ($route->attributes as $key => $value) {
            $request = $request->withAttribute($key, $value);
        }
        $result = $this->runBefores();
        if ($result) {
            $this->emitResponse($result);
            return;
        }
        $callable = $route->handler;
        $response = $callable($request);
        $this->emitResponse($response);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param Object $response Directory's path
     *
     * @access protected 
     * 
     * @return array | object
     */ 
    protected function emitResponse(ResponseInterface $response) 
    {
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }

}
