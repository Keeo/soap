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
    public function getStatistics($websiteName, $full = false)
    {
        $website = $this->websiteRepository->findOneByName($websiteName);
        $ret = [];
        $words = $this->wordRepository->findByWebsite($website, array('count' => 'DESC'), 30);
        foreach ($words as $word)
        {
            $out = [];
            $out['message'] = $word->getMessage();
            $out['count'] = $word->getCount();
            $out['friends'] = 0;
            $out['friend_message'] = [];

            foreach ($word->getSimilars() as $friend)
            {
                $out['friends'] += $friend->getCount();
                $out['friend_message'][] = $friend->getMessage();
            }
            foreach ($word->getSimilarities() as $friend)
            {
                $message = $friend->getMessage();
                if (!in_array($message, $out['friend_message'])) {
                    $out['friends'] += $friend->getCount();
                    $out['friend_message'][] = $message;
                }
            }
            $ret[] = $out;
        }
        return $ret;
    }
}
