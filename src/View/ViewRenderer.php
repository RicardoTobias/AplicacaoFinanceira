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

namespace SONFin\View;

use Psr\Http\Message\ResponseInterface;
use Zend\Diactoros\Response;

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
class ViewRenderer implements ViewRendererInterface
{

    private $_twigEnviroment;

    /**
     * Função para  gravar imagem em diretório
     * 
     * @param object $twigEnviroment contain object from Twig
     * 
     * @access public 
     * 
     * @return object
     */
    public function __construct(\Twig_Environment $twigEnviroment) 
    {
        $this->_twigEnviroment = $twigEnviroment;
    }

    /**
     * Função para  gravar imagem em diretório
     * 
     * @param string $template contain string
     * @param array  $context  contain array
     * 
     * @access public 
     * 
     * @return object
     */
    public function render(
        string $template, 
        array $context = []
    ): ResponseInterface {
        $result = $this->_twigEnviroment->render($template, $context);
        $response = new Response();
        $response->getBody()->write($result);
        return $response;
    }

}
