<?php
/**
 * @author José Jaime Ramírez Calvo <jaime@osmos.mx>
 * @version 1
 * @date 2018-01-23
 */

namespace App\Report;


use Doctrine\ORM\EntityManager;
use Twig\Template;

/**
 * Helper to generate reports on specific format over specific tables. This class needs to be inheritance
 * If format is excel, there's something more to do because blocks and cells must be defined as well
 *
 * Class AbstractReport
 * @package Report
 */
abstract class AbstractReport
{
    /*
     * Send report as binary file
     */
    const OUTPUT_BINARY = 0;

    /*
     * Send report as text (path)
     */
    const OUTPUT_TEXT = 1;

    /**
     * Report name
     * @var string $_name
     */
    protected $_name;

    /**
     * Output format
     * @var string $_format
     */
    protected $_format;

    /**
     * Output as response
     * @var int $_output
     */
    protected $_output;

    /**
     * @var Template $_templating
     */
    private $templating;

    /**
     * @var EntityManager $em;
     */
    private $em;

    /**
     * AbstractReport constructor.
     * @param EntityManager $em
     * @param Template $templating
     * @param array $options
     */
    public function __construct(EntityManager $em, Template $templating, array $options = [])
    {
        $this->em = $em;
        $this->templating = $templating;
        $this->_format = isset($options["format"]) ? $options["format"] : "csv"; // Maybe fetched from parameters
        $this->_output = isset($options["output"]) ? $options["output"] : self::OUTPUT_TEXT;
    }
}