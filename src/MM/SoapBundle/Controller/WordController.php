<?php

namespace MM\SoapBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * @Route("/word")
 */
class WordController extends Controller
{
    /**
     * @Route("/set/{websiteName}/{word}")
     * @Template()
     */
    public function insertWordAction($websiteName, $word)
    {
        $wd = $this->get('word_diff');
        $wd->saveWord($word, $websiteName);
    }
    
    /**
     * @Route("/get/{websiteName}")
     * @Template()
     */
    public function getStatisticsAction($websiteName)
    {
        $wr = $this->get('word_response');
        $statistics = $wr->getStatistics($websiteName);
        $response = new JsonResponse();
        $response->setData($statistics);
        return $response;
    }
}
