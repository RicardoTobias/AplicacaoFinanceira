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
namespace SONFin\Models;
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
interface UserInterface
{

    /** 
     * Get user's Id
     *
     * @access public 
     * 
     * @return int
     */
    public function getId(): int;

    /** 
     * Get user's full name
     *
     * @access public 
     * 
     * @return string
     */
    public function getFullname(): string;

    /** 
     * Get user's email
     *
     * @access public 
     * 
     * @return string
     */
    public function getEmail(): string;

    /** 
     * Get user's password
     *
     * @access public 
     * 
     * @return string
     */
    public function getPassword(): string;
}
