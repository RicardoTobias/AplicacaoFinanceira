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

namespace SONFin\View\Twig;

use SONFin\Auth\AuthInterface;

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
class TwigGlobals extends \Twig_Extension implements \Twig_Extension_GlobalsInterface
{

    private $_auth;

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param object $auth contain string
     * 
     * @access public 
     * 
     * @return object
     */ 
    public function __construct(AuthInterface $auth) 
    {
        $this->_auth = $auth;
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function getGlobals() 
    {
        return [
            'Auth' => $this->_auth
        ];
    }

}
