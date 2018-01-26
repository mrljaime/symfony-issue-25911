<?php
/**
 * @author José Jaime Ramírez Calvo <jaime@osmos.mx>
 * @version 0.1
 * @date 2018-01-23
 */

namespace App\Repository;

/**
 * Allow to handle database interaction with paysheet_paysheets database and relationships
 *
 * Class PaysheetRepository
 * @package Repository
 */
class PaysheetRepository extends AbstractRepository
{
    /**
     * @var string $table
     */
    public $table = "paysheet_paysheets";
}