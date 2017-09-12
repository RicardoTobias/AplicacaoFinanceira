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

namespace SONFin\Repository;

use Illuminate\Database\Eloquent\Model;
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
class DefaultRepository implements RepositoryInterface
{

    private $_modelClass;
    private $_model;

    /**
     * DefaultRepository constructor.
     *
     * @param string $modelClass a string var
     */
    public function __construct(string $modelClass) 
    {
        $this->_modelClass = $modelClass;
        $this->_model = new $modelClass;
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function all(): array 
    {
        return $this->_model->all()->toArray();
    }

    /** 
     * Função para  gravar imagem em diretório
     * 
     * @param array $data contain data
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function create(array $data) 
    {
        $this->_model->fill($data);
        $this->_model->save();
        return $this->_model;
    }

    /** 
     * Função para  gravar imagem em diretório
     
     * @param int   $id   contain id
     * @param array $data contain data
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function update($id, array $data) 
    {
        $model = $this->findInternal($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    /** 
     * Função para  gravar imagem em diretório
     
     * @param int $id contain id
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function delete($id) 
    {
        $model = $this->findInternal($id);
        $model->delete();
    }

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param int $id contain id
     * 
     * @access public 
     * 
     * @return array
     */ 
    protected function findInternal($id) 
    {
        return is_array($id) ? $this->findOneBy($id) : $this->find($id);
    }

    /** 
     * Função para  gravar imagem em diretório
     
     * @param int  $id             contain id
     * @param bool $failIfNotExist contain bool: true or false
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function find(int $id, bool $failIfNotExist = true) 
    {
        return $failIfNotExist ? $this->_model->findOrFail($id) :
                $this->_model->find($id);
    }

    /** 
     * Função para  gravar imagem em diretório
     
     * @param string $field contain fild's name
     * @param string $value contain value's name
     * 
     * @access public 
     * 
     * @return array
     */ 
    public function findByField(string $field, $value) 
    {
        return $this->_model->where($field, '=', $value)->get();
    }

    /** 
     * Função para  gravar imagem em diretório
     
     * @param int $search contain search data
     *
     * @access public 
     * 
     * @return array
     */ 
    public function findOneBy(array $search) 
    {
        $queryBuilder = $this->_model;
        foreach ($search as $field => $value) {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        return $queryBuilder->firstOrFail();
    }

}
