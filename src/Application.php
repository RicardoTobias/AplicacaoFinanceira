<?php
/** 
 * Comentário de cabeçalho de arquivos
 * Esta classe de upload de fotos
 *
 * @author     leo genilhu <leo@genilhu.com>
 * @version    0.1 
 * @copyright  GPL © 2006, genilhu ltda. 
 * @access     public  
 * @package    Infra_Estrutura 
 * @subpackage UploadGenilhu
 * @example    Classe uploadGenilhu. 
 */ 

declare(strict_types = 1);

namespace SONFin;

use SONFin\Plugins\PluginInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response\SapiEmitter;
use Zend\Diactoros\Response\RedirectResponse;

class Application
{

    /** 
     * Comentário de variáveis
     * Variável recebe o diretório para gravar as fotos. 
     *
     * @access private 
     * @name   $diretorio 
     */ 
    private $serviceContainer;
    private $_befores = [];

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function __construct(ServiceContainerInterface $serviceContainer) 
    {
        $this->serviceContainer = $serviceContainer;
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function service($name) 
    {
        return $this->serviceContainer->get($name);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function addService(string $name, $service): void 
    {
        if (is_callable($service)) {
            $this->serviceContainer->addLazy($name, $service);
        } else {
            $this->serviceContainer->add($name, $service);
        }
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function plugin(PluginInterface $plugin): void 
    {
        $plugin->register($this->serviceContainer);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
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
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
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
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function redirect($path) 
    {
        return new RedirectResponse($path);
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
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
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
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
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
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
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    public function start(): void 
    {
        $route = $this->service('route');
        /**
         * @var ServerRequestInterface $request
         */
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
     * @access public 
     * @param  String $imagem_nome
     * @param  String $diretorio
     * @return void 
     */ 
    protected function emitResponse(ResponseInterface $response) 
    {
        $emitter = new SapiEmitter();
        $emitter->emit($response);
    }

}
