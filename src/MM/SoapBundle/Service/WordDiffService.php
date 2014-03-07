<?php

/**
 * @author Martin Morávek
 * @email moravek.martin@gmail.com
 */
namespace MM\SoapBundle\Service;

use MM\SoapBundle\Entity\Word;
use MM\SoapBundle\Entity\Website;


class WordDiffService extends WordAbstractService
{
    
    public function saveWord($message, $site, $diff = 1)
    {
        $website = $this->getSite($site);
        
        $word = $this->wordRepository->findOneByMessage($message);
        if (empty($word)) {
            $word = new Word();
            $word->setMessage($message);
            $word->setWebsite($website);
            $word->setCount(1);
            $this->em->persist($word);
            $this->em->flush();
            
            $fwords = $this->wordRepository->findAll();
            foreach ($fwords as $fword) {
                if ($this->sim($fword, $word) == $diff) {
                    $word->addSimilar($fword);
                }
            }
        } else {
            $word->incCount();
        }
        $this->em->persist($word);
        $this->em->flush();
    }
    
    private function sim(Word $a,Word $b)
    {
        $wa = trim(strtolower($a->getMessage()));
        $wb = trim(strtolower($b->getMessage()));
        return levenshtein($wa, $wb);
    }
    
    private function getSite($name)
    {
        $site = $this->websiteRepository->findOneByName($name);
        if (empty($site)) {
            $site = new Website();
            $site->setName($name);
            $this->em->persist($site);
            $this->em->flush();
        }
        return $site;
    }
}
