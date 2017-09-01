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

namespace SONFin\Models;

use Illuminate\Database\Eloquent\Model;
use Jasny\Auth\User as JasnyUser;
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
class User extends Model implements JasnyUser, UserInterface
{

    /**
     * Private variable
     * 
     * @var $fillable
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password'
    ];

    /**
     * Get user id
     *
     * @return int|string
     */
    public function getId(): int 
    {
        return (int) $this->id;
    }

    /**
     * Get user's username
     *
     * @return string
     */
    public function getUsername(): string 
    {
        return $this->email;
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getHashedPassword(): string 
    {
        return $this->password;
    }

    /**
     * Get user's on login
     *
     * @return bool
     */
    public function onLogin() 
    {
    }

    /**
     * Get on logout
     *
     * @return void
     */
    public function onLogout() 
    {   
    }

    /**
     * Get user's email
     *
     * @return string
     */
    public function getEmail(): string 
    {
        return $this->email;
    }

    /**
     * Get user's full name
     *
     * @return string
     */
    public function getFullname(): string 
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Get user's hashed password
     *
     * @return string
     */
    public function getPassword(): string 
    {
        return $this->password;
    }

}
