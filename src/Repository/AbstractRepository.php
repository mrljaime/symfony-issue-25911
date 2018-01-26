<?php
/**
 * @author José Jaime Ramírez Calvo <jaime@osmos.m>
 * @version 1
 * @date 2018-01-23
 */

namespace App\Repository;


use Doctrine\ORM\EntityManager;
use App\Exception\TableNotDeclaredExeption;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;

/**
 * Create to inheritance all repositories (or almost all)
 * Autowired EntityManager and LoggerInterface
 *
 * Class AbstractRepository
 * @package Repository
 */
abstract class AbstractRepository
{
    /**
     * @var EntityManager $_em;
     */
    protected $_em;

    /**
     * @var LoggerInterface $_logger
     */
    protected $_logger;

    /**
     * Use to query over principal table
     *
     * @var string $table
     */
    public $table = null;

    /**
     * AbstractRepository constructor.
     * @param EntityManagerInterface $em
     * @param LoggerInterface $logger
     */
    public function __construct(EntityManagerInterface $em, LoggerInterface $logger)
    {
        $this->_em = $em;
        $this->_logger = $logger;
    }

    /**
     * Use to fetch row by id
     *
     * @param $id
     * @return array|null
     * @throws TableNotDeclaredExeption
     */
    public function find($id)
    {
        $this->validateTableAttribute();

        $stmt = <<<SQL
SELECT 
  *
FROM {$this->table}
WHERE id = :id
SQL;

        $result = $this->_em->getConnection()->executeQuery($stmt, ["id" => $id])->fetchAll();
        if (0 === count($result)) {

            return null;
        }

        return $result[0];
    }

    /**
     * @param $uniqueId
     * @return null|array
     */
    public function findByUniqueId($uniqueId)
    {
        $this->validateTableAttribute();

        $stmt = <<<SQL
SELECT 
  *
FROM {$this->table}
WHERE unique_id = :uniqueId
SQL;

        $result = $this->_em->getConnection()->executeQuery($stmt, ["uniqueId" => $uniqueId])->fetchAll();

        if (0 === count($result)) {

            return null;
        }

        return $result[0];
    }

    /**
     * @throws TableNotDeclaredExeption
     */
    private function validateTableAttribute()
    {
        if (is_null($this->table)) {
            throw new TableNotDeclaredExeption("The table attribute was not override", 500);
        }
    }
}