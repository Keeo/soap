<?php

/**
 * @author Martin Morávek
 * @email moravek.martin@gmail.com
 */
namespace MM\SoapBundle\Service;

use MM\SoapBundle\Entity\Word;
use MM\SoapBundle\Entity\Website;


class WordAbstractService
{
    protected $doctrine;        

    /** @var \Doctrine\ORM\EntityManager */
    protected $em;
    
    /** @var \MM\SoapBundle\Entity\WordRepository */
    protected $wordRepository;
    
    /** @var \MM\SoapBundle\Entity\WebsiteRepository */
    protected $websiteRepository;
    
    public function __construct($doctrine) {
        $this->doctrine = $doctrine;
        $this->em = $this->doctrine->getManager();
        
        $this->websiteRepository = $this->em->getRepository('MMSoapBundle:Website');
        $this->wordRepository = $this->em->getRepository('MMSoapBundle:Word');
    }
    
}
