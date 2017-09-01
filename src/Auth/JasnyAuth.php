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
namespace SONFin\Auth;

use Jasny\Auth\Sessions;
use Jasny\Auth\User;
use SONFin\Repository\RepositoryInterface;

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
class JasnyAuth extends \Jasny\Auth
{

    use Sessions;

    /**
     * Private variable
     * 
     * @var RepositoryInterface
     */
    private $_repository;

    /**
     * JasnyAuth constructor.
     * 
     * @param int|string $_repository Respository Interface
     * 
     * @return bool
     */
    public function __construct(RepositoryInterface $_repository) 
    {
        $this->_repository = $_repository;
    }

    /**
     * Fetch a user by ID
     *
     * @param int|string $id Credentials Id User
     * 
     * @return User|null
     */
    public function fetchUserById($id) 
    {
        return $this->_repository->find($id, false);
    }

    /**
     * Fetch a user by username
     *
     * @param string $username Username for credentials
     * 
     * @return User|null
     */
    public function fetchUserByUsername($username) 
    {
        return $this->_repository->findByField('email', $username)[0];
    }

}
