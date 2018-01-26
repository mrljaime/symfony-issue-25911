<?php
/**
 * First interaction with Symfony's 4
 *
 * @author José Jaime Ramírez Calvo <jaime@osmos.mx>
 * @version 0.1
 * @date 2018-01-22
 */

namespace App\Controller;


use Doctrine\ORM\EntityManager;
use App\Report\AbstractReport;
use App\Report\AccoutingAccountReport;
use App\Repository\PaysheetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use App\Util\HttpUtil;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends Controller
{
    /**
     * @Route("/report/{paysheet}")
     *
     * @param $paysheet
     * @return JsonResponse
     */
    public function accoutingAccountReport($paysheet)
    {
        /** @var EntityManager $em */
        $em = $this->getDoctrine()->getManager();
        /** @var PaysheetRepository $paysheetRepository */
        $paysheetRepository = $this->get(PaysheetRepository::class);

        $paysheet = $paysheetRepository->findByUniqueId($paysheet);

        /*
         * Nothing to do
         */
        if (is_null($paysheet)) {

            return $this->json([
                "code" => HttpUtil::HTTP_NOT_FOUND,
                "error" => "No se ha encontrado el recurso",
            ]);
        }

        /*
        $accoutingAccountReporter = new AccoutingAccountReport($em, $templating, [
            "format"    => "csv",
            "output"    => AbstractReport::OUTPUT_TEXT
        ]);
        */

        return $this->json([
            "code"  => HttpUtil::HTTP_OK,
            "data"  => "Aquí",
        ]);
    }
}