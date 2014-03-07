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
     * @Template
     */
    public function insertWordAction($websiteName, $word)
    {
        $websiteName = urldecode($websiteName);
        $wd = $this->get('word_diff');
        $wd->saveWord($word, $websiteName);
    }
    
    /**
     * @Route("/get/{websiteName}")
     * @Template
     */
    public function getStatisticsAction($websiteName)
    {
        $websiteName = urldecode($websiteName);
        $statistics = $this->get('word_response')->getStatistics($websiteName);
        return new JsonResponse($statistics);
    }
    
    /**
     * @Route("/show/{websiteName}")
     * @Template
     */
    public function showStatisticsAction($websiteName)
    {
        $websiteName = urldecode($websiteName);
        $statistics = $this->get('word_response')->getStatistics($websiteName, true);
        return array('statistics' => $statistics);
    }
}
