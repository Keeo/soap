<?php

/**
 * @author Martin Morávek
 * @email moravek.martin@gmail.com
 */
namespace MM\SoapBundle\Service;

use MM\SoapBundle\Entity\Word;
use MM\SoapBundle\Entity\Website;


class WordResponseService extends WordAbstractService
{
    public function getStatistics($websiteName)
    {
        $website = $this->websiteRepository->findOneByName($websiteName);
        $ret = [];
        $words = $this->wordRepository->findByWebsite($website, array('count' => 'DESC'), 30);
        foreach ($words as $word)
        {
            $out['message'] = $word->getMessage();
            $out['count'] = $word->getCount();
            $out['friends'] = 0;
            foreach ($word->getSimilars() as $friends)
            {
                $out['friends'] += $friends->getCount();
            }
            foreach ($word->getSimilarities() as $friends)
            {
                $out['friends'] += $friends->getCount();
            }
            $ret[] = $out;
        }
        return $ret;
    }
}
