<?php
/**
 * Add User to Category Costs
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
class AddUserToCategoryCosts extends AbstractMigration
{

    /** 
     * MÉTODO UP
     * 
     * Método para ligar o usuário com a categoria relacionado ao mesmo
     * 
     * @access public 
     * 
     * @return void
     */
    public function up() 
    {
        $this->table('category_costs')
            ->addColumn('user_id', 'integer')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    /** 
     * DOWN
     * 
     * Método para remover a chave estrangeira da tabela User com a tabela
     * Category-costs
     * 
     * @access public 
     * 
     * @return void
     */
    public function down() 
    {
        $this->table('category_costs')
            ->dropForeignKey('user_id')
            ->removeColumn('user_id');
    }

}
