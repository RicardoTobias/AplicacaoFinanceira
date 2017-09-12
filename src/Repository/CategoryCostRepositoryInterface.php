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
interface CategoryCostRepositoryInterface extends RepositoryInterface
{

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
    ): array;
}
