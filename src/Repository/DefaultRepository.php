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

    /**
     * @var string
     */
    private $_modelClass;

    /**
     * @var Model
     */
    private $_model;

    /**
     * DefaultRepository constructor.
     *
     * @param string $modelClass
     */
    public function __construct(string $modelClass) 
    {
        $this->_modelClass = $modelClass;
        $this->_model = new $modelClass;
    }

    public function all(): array 
    {
        return $this->_model->all()->toArray();
    }

    public function create(array $data) 
    {
        $this->_model->fill($data);
        $this->_model->save();
        return $this->_model;
    }

    public function update($id, array $data) 
    {
        $model = $this->findInternal($id);
        $model->fill($data);
        $model->save();
        return $model;
    }

    public function delete($id) 
    {
        $model = $this->findInternal($id);
        $model->delete();
    }

    protected function findInternal($id) 
    {
        return is_array($id) ? $this->findOneBy($id) : $this->find($id);
    }

    public function find(int $id, bool $failIfNotExist = true) 
    {
        return $failIfNotExist ? $this->_model->findOrFail($id) :
                $this->_model->find($id);
    }

    public function findByField(string $field, $value) 
    {
        return $this->_model->where($field, '=', $value)->get();
    }

    public function findOneBy(array $search) 
    {
        $queryBuilder = $this->_model;
        foreach ($search as $field => $value) {
            $queryBuilder = $queryBuilder->where($field, '=', $value);
        }

        return $queryBuilder->firstOrFail();
    }

}
