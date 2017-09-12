<?php
/**
 * Create Bill Receives
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
class CreateBillReceivesTable extends AbstractMigration
{

    /** 
     * MÉTODO UP
     * 
     * Método para criar tabela e colunas
     * 
     * @access public 
     * 
     * @return void
     */
    public function up() 
    {
        $this->table('bill_receives')
            ->addColumn('date_launch', 'date')
            ->addColumn('name', 'string')
            ->addColumn('value', 'float')
            ->addColumn('user_id', 'integer')
            ->addColumn('created_at', 'datetime')
            ->addColumn('updated_at', 'datetime')
            ->addForeignKey('user_id', 'users', 'id')
            ->save();
    }

    /** 
     * DOWN
     * 
     * Método para remover tabela
     * 
     * @access public 
     * 
     * @return void
     */
    public function down() 
    {
        $this->dropTable('bill_receives');
    }

}
