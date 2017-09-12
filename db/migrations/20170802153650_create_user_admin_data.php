<?php
/**
 * Create User Admin Data
 * 
 * Este arquivo foi gerado após a instalação da biblioteca PHINX via composer.
 * Para criar o mesmo, rodamos estes comandos no terminal dentro do projeto:
 * vendor/bin/phinx ou vendor/bin/phinx.bat (windows)
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

use Phinx\Migration\AbstractMigration;

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
class CreateUserAdminData extends AbstractMigration
{

    /** 
     * MÉTODO UP
     * 
     * Método para inserir um usuário como adminitrador do sistema
     * 
     * @access public 
     * 
     * @return void
     */
    public function up() 
    {
        $app = include __DIR__ . '/../bootstrap.php';
        $auth = $app->service('auth');

        $users = $this->table('users');
        $users->insert(
            [
            'first_name' => 'Admin',
            'last_name' => 'System',
            'email' => 'admin@user.com',
            'password' => $auth->hashPassword('123456'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ]
        )->save();
    }

    /** 
     * DOWN
     * 
     * Método para excluir o administrador do sistema
     * 
     * @access public 
     * 
     * @return void
     */
    public function down() 
    {
        $this->execute("DELETE FROM users WHERE email = 'admin@user.com'");
    }

}
