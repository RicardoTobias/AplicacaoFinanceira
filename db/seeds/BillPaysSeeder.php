<?php
/**
 * Bill Pays Seeder
 * 
 * Este arquivo serve alimenta a base de dados de forma automatizada, sem
 * precisar usar o Front End do sistema. Após rodarmos o comando 
 * vendor/bin/phinx.bat migrate (windows) ou vendor\bin\phinx migrate
 * executaremos os comandos para criar as Seeds:
 * vendor\bin\phinx seed:create CategoryCostsSeeder ou
 * vendor/bin/phinx.bat seed:create CategoryCostsSeeder
 * 
 * Para fins de teste, existe uma biblioteca chamada Faker. Esta biblioteca
 * cria dados falsos a fim de ver como ficaria o sistema com os dados 
 * preenchidos.
 * 
 * PHP version 7.1
 * 
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Heroku Application
 * 
 * @see Phinx
 * @see Faker
 */

use Phinx\Seed\AbstractSeed;
use SONFin\Models\CategoryCost;
use Faker\Factory;
use Faker\Provider\Base;

/**
 * BillPaysSeeder
 * 
 * Esta classe nos servirá para alimentar a base de dados de forma automática.
 * Após criarmos a classe, executaremos o comando:
 * vendor/bin/phinx seed:run para alimentarmos a base.
 * 
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias Ltd
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Financial Application
 */
class BillPaysSeeder extends AbstractSeed
{
    /**
     * Adicionaremos alguns valores com a instancia da Model Class
     * 
     * @var array $_categories Campos da tabela category-costs
     * @see Model CategoryCost
     */
    private $_categories;
    
    /** 
     * Run
     * 
     * Este método executa a função de alimentar a base de dados
     * 
     * @access public 
     * 
     * @return array
     */
    public function run()
    {
        // 
        include __DIR__ . '/../bootstrap.php';
        
        /**
         * Armanzenamos os campos da tabela CategoryCost através da Model Class
         */
        $this->_categories = CategoryCost::all();
        
        // Aqui adicionaremos o método create com os dados em Português
        $faker = Factory::create('pt_BR');
        
        //
        $faker->addProvider($this);
        
        // Iremos informar para onde os dados serão armazenados
        $billPays = $this->table('bill_pays');
        
        //
        $data = [];
        
        //
        foreach (range(1, 20) as $value) {
            $userId = rand(1, 4);
            $data[] = [
            'date_launch' => $faker->dateTimeBetween(
                '-1 month'
            )->format(
                'Y-m-d'
            ),
            'name' => $faker->word,
            'value' => $faker->randomFloat(2, 10, 1000),
            'user_id' => $userId,
            'category_cost_id' => $faker->categoryId($userId),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        // Se tudo ocorrer bem, finalmente os dados serão salvos na base
        $billPays->insert($data)->save();
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param int $userId User's id
     * 
     * @access public 
     * 
     * @return array
     */
    public function categoryId($userId) 
    {
        $categories = $this->_categories->where('user_id', $userId);
        $categories = $categories->pluck('id');
        return Base::randomElement($categories->toArray());
    }

}
