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

namespace SONFin;

use Xtreamwayz\Pimple\Container;

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
class ServiceContainer implements ServiceContainerInterface
{

    private $_container;

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @access public 
     * 
     * @return object
     */ 
    public function __construct() 
    {
        $this->_container = new Container();
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param string $name    contain string
     * @param string $service contain string
     * 
     * @access public 
     * 
     * @return string
     */ 
    public function add(string $name, $service) 
    {
        $this->_container[$name] = $service;
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param string $name     contain string
     * @param string $callable contain string
     * 
     * @access public 
     * 
     * @return string
     */ 
    public function addLazy(string $name, callable $callable) 
    {
        $this->_container[$name] = $this->_container->factory($callable);
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param string $name contain string name
     * 
     * @access public 
     * 
     * @return string
     */ 
    public function get(string $name) 
    {
        return $this->_container->get($name);
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param string $name contain string
     * 
     * @access public 
     * 
     * @return string
     */ 
    public function has(string $name) 
    {
        return $this->_container->has($name);
    }

}
