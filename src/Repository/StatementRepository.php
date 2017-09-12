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

use Illuminate\Support\Collection;
use SONFin\Models\BillPay;
use SONFin\Models\BillReceive;
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
class StatementRepository implements StatementRepositoryInterface
{

    /** 
     * Função para  gravar imagem em diretório
     *
     * @param string $dateStart Start date
     * @param string $dateEnd   End date
     * @param int    $userId    User's id
     * 
     * @access public
     * 
     * @return string 
     */ 
    public function all(string $dateStart, string $dateEnd, int $userId): array 
    {
        //select from bill_pays left join category_costs
        $billPays = BillPay::query()
                ->selectRaw('bill_pays.*, category_costs.name as category_name')
                ->leftJoin(
                    'category_costs', 
                    'category_costs.id', 
                    '=', 
                    'bill_pays.category_cost_id'
                )
                ->whereBetween('date_launch', [$dateStart, $dateEnd])
                ->where('bill_pays.user_id', $userId)
                ->get();

        $billReceives = BillReceive::query()
                ->whereBetween('date_launch', [$dateStart, $dateEnd])
                ->where('user_id', $userId)
                ->get();

        //$billPays -> Collection [0 => BillPay, 1 => BillPay..]
        //$billReceives -> Collection [0 => BillReceive,1 => BillReceive..]

        $collection = new Collection(
            array_merge_recursive(
                $billPays->toArray(), 
                $billReceives->toArray()
            )
        );
        $statements = $collection->sortByDesc('date_launch');
        return [
            'statements' => $statements,
            'total_pays' => $billPays->sum('value'),
            'total_receives' => $billReceives->sum('value')
        ];
    }

}
