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
namespace SONFin\Auth;

use SONFin\Models\UserInterface;

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
class Auth implements AuthInterface
{
    /**
     * Private variable
     * 
     * @var $_jasnyAuth
     */
    private $_jasnyAuth;

    /**
     * __construct
     *
     * @param array JasnyAuth $_jasnyAuth Implemeting anothers function
     * 
     * @access public 
     * 
     * @return bool
     */
    public function __construct(JasnyAuth $_jasnyAuth)
    {
        $this->_jasnyAuth = $_jasnyAuth;
        $this->sessionStart();
    }

    /**
     * Login
     *
     * @param array $credentials Login credentials
     * 
     * @access public 
     * 
     * @return bool
     */
    public function login(array $credentials): bool
    {
        list('email' => $email, 'password' => $password) = $credentials;
        return $this->_jasnyAuth->login($email, $password) !== null;
    }

    /**
     * Check
     *
     * @access public 
     * 
     * @return bool
     */
    public function check(): bool
    {
        return $this->user() !== null;
    }

    /**
     * Logout
     *
     * @access public 
     * 
     * @return void
     */
    public function logout(): void
    {
        $this->_jasnyAuth->logout();
    }

    /**
     * Hash Password
     *
     * @param string $password Password to credetials users
     * 
     * @access public 
     * 
     * @return string
     */
    public function hashPassword(string $password): string
    {
        return $this->_jasnyAuth->hashPassword($password);
    }

    // Criando o método sessionStart() ao final da classe
    /**
     * Session start
     *
     * @access public 
     * 
     * @return bool
     */
    protected function sessionStart()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * User
     *
     * @access public 
     * 
     * @return bool
     */
    public function user(): ?UserInterface
    {
        return $this->_jasnyAuth->user();
    }

}
