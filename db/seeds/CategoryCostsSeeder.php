<?php
/**
 * Category Costs Seeder
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
use Faker\Factory;
use Faker\Provider\Base;

/**
 * CategoryCostsSeeder
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
class CategoryCostsSeeder extends AbstractSeed
{

    /**
     * Esta constante, incluirá todos estes dados na tabela pelos mesmos 
     * não existirem na biblioteca Phinx.
     */
    const NAMES = [
        'Telefone',
        'Água',
        'Escola',
        'Cartão',
        'LUZ',
        'IPVA',
        'Imposto de Renda',
        'Gasolina',
        'Vestuário',
        'Entretenimento',
        'Reparos'
    ];

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
        // Aqui adicionaremos o método create com os dados em Português
        $faker = Factory::create('pt_BR');
        
        //
        $faker->addProvider($this);
        
        // Iremos informar para onde os dados serão armazenados
        $categoryCosts = $this->table('category_costs');
        
        //
        $data = [];
        
        //
        foreach (range(1, 20) as $value) {
            $data[] = [
                'name' => $faker->categoryName(),
                'user_id' => rand(1, 4),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ];
        }
        
        // Se tudo ocorrer bem, finalmente os dados serão salvos na base
        $categoryCosts->insert($data)->save();
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @access public 
     * 
     * @return array
     */
    public function categoryName() 
    {
        return Base::randomElement(self::NAMES);
    }

}
