<?php
/**
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
 * Interface document for Authetication Class
 * 
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Financial Application
 */
interface AuthInterface
{

    /** 
     * Login
     *
     * @param array $credentials Login credentials
     * 
     * @access public 
     * 
     * @return bool
     */ 
    public function login(array $credentials): bool;

    /** 
     * Check
     *
     * @access public 
     * 
     * @return bool
     */
    public function check(): bool;

    /** 
     * Logout
     *
     * @access public 
     * 
     * @return void
     */
    public function logout(): void;

    /** 
     * Hash Password
     *
     * @param string $password Password to credetials users
     * 
     * @access public 
     * 
     * @return string
     */
    public function hashPassword(string $password): string;
    
    /** 
     * User
     *
     * @access public 
     * 
     * @return bool
     */
    public function user(): ?UserInterface;
}
