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
namespace SONFin\Repository;
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
interface RepositoryInterface
{

    /** 
     * Função para  gravar imagem em diretório
     *
     * @access public
     * 
     * @return array
     */ 
    public function all(): array;

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param int  $id             Service name
     * @param bool $failIfNotExist Service name
     * 
     * @access public
     * 
     * @return int & bool
     */ 
    public function find(int $id, bool $failIfNotExist = true);

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param array $data Service name
     * 
     * @access public
     * 
     * @return array
     */ 
    public function create(array $data);

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param int   $id   Service name
     * @param array $data Service name
     * 
     * @access public
     * 
     * @return array
     */ 
    public function update($id, array $data);

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param int $id Service name
     * 
     * @access public
     * 
     * @return array
     */ 
    public function delete($id);

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param String $field Service name
     * @param array  $value Description
     * 
     * @access public
     * 
     * @return array
     */ 
    public function findByField(string $field, $value);

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param array $search Service name
     * 
     * @access public
     * 
     * @return array
     */ 
    public function findOneBy(array $search);
}
