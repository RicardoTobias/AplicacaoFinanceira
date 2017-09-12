<?php
/**
 * MIGRATIONS - PHP PHINX.
 * 
 * Este arquivo serve para a configuração das Migrations (Migrações) no PHP!
 * No caso, estamos trabalhando com a biblioteca PHINX para gerar as tabelas no
 * banco de dados. E para isso, este arquivo depende de outro documento que 
 * está no caminho: /config/db.php e o .env. Após configurar os arquivos 
 * no caminho /db/migrations e /db/seeds, no terminal rodar o comando: 
 * vendor/bin/phinx.bat migrate (windows) ou vendor\bin\phinx migrate
 * 
 * PHP version 7.1
 *
 * @category  Financial_Apllication
 * @package   RTW_System
 * @author    Ricardo Tobias <ricardosantostobias@yahoo.com.br>
 * @copyright 2017 Ricardo Tobias
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GPL
 * @link      https://cryptic-hollows-97873.herokuapp.com Heroku Application
 * 
 * @see phinx
 * @see phpdotenv
 */

/**
 *  (Dotenv) é uma biblioteca para carregar os dados do arquivo .env na raiz da aplicação
 */
use Dotenv\Dotenv;

require __DIR__ . '/vendor/autoload.php';

// Neste trecho, aqui verifica se o arquivo .env existe
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = new Dotenv(__DIR__);
    $dotenv->overload();
}

// Após carregar o arquivo .env, carregaremos o arquivo no caminho config/db.php
$db = include __DIR__ . '/config/db.php';

/** 
 * Este construtor list(para a versão 7.1 do PHP) permite trabalhar com
 * arrays internos. Neste caso, fazemos comparação com o array $db.
 * 
 * @see list()
 */
list(
    'driver' => $adapter,
    'host' => $host,
    'database' => $name,
    'username' => $user,
    'password' => $pass,
    'charset' => $charset,
    'collation' => $collation
) = $db['default_connection'];

// Aqui retornamos duas informações "paths" e "enviroments"
return [
    
    //
    'paths' => [
        'migrations' => [
            __DIR__ . '/db/migrations'
        ],
        'seeds' => [
            __DIR__ . '/db/seeds'
        ]
    ],
    
    //
    'environments' => [
        
        //
        'default_migration_table' => 'migrations',
        
        //
        'default_database' => 'default_connection',
        
        //
        'default_connection' => [
            'adapter' => $adapter,
            'host' => $host,
            'name' => $name,
            'user' => $user,
            'pass' => $pass,
            'charset' => $charset,
            'collation' => $collation
        ]
    ]
];
