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

use SONFin\Models\CategoryCost;
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
class CategoryCostRepository extends DefaultRepository implements CategoryCostRepositoryInterface
{

    /**
     * JasnyAuth constructor.
     * 
     * @return objetc
     */
    public function __construct() 
    {
        parent::__construct(CategoryCost::class);
    }

    /**
     * Fetch a user by ID
     *
     * @param string $dateStart Inicial date
     * @param string $dateEnd   End date
     * @param int    $userId    Iser's id
     * 
     * @return array
     */
    public function sumByPeriod(
        string $dateStart, 
        string $dateEnd, 
        int $userId
    ): array { 
    
        $categories = CategoryCost::query()
                ->selectRaw('category_costs.name, sum(value) as value')
                ->leftJoin(
                    'bill_pays', 
                    'bill_pays.category_cost_id', 
                    '=', 
                    'category_costs.id'
                )
                ->whereBetween('date_launch', [$dateStart, $dateEnd])
                ->where('category_costs.user_id', $userId)
                ->whereNotNull('bill_pays.category_cost_id')
                ->groupBy('value')
                ->groupBy('category_costs.name')
                ->get();
        return $categories->toArray();
    }

}
