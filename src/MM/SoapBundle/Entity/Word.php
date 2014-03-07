<?php

namespace MM\SoapBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint;
use Doctrine\ORM\Mapping\Index;

/**
 * Word
 *
 * @ORM\Table(
 *  uniqueConstraints={@UniqueConstraint(name="message_website_unique",columns={"message", "website_id"})},
 *  indexes={@index(name="message_idx", columns={"message","website_id"})}
 * )
 * @ORM\Entity(repositoryClass="MM\SoapBundle\Entity\WordRepository")
 */
class Word
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;


    /**
     * @ORM\ManyToMany(targetEntity="Word", mappedBy="similars")
     */
    private $similarities;

    /**
     * @ORM\ManyToMany(targetEntity="Word", inversedBy="similarities")
     * @ORM\JoinTable(name="words_words")
     */
    private $similars;
    
    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=100)
     */
    private $message;

    /**
     * @ORM\Column(name="count", type="integer")
     */
    private $count;

    /**
     * @ORM\ManyToOne(targetEntity="Website", inversedBy="words")
     * @ORM\JoinColumn(name="website_id", referencedColumnName="id")
     */
    private $website;
    
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set string
     *
     * @param string $string
     * @return Word
     */
    public function setString($string)
    {
        $this->string = $string;

        return $this;
    }

    /**
     * Get string
     *
     * @return string 
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Word
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->similarities = new \Doctrine\Common\Collections\ArrayCollection();
        $this->similars = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Set count
     *
     * @param integer $count
     * @return Word
     */
    public function setCount($count)
    {
        $this->count = $count;

        return $this;
    }

    /**
     * Get count
     *
     * @return integer 
     */
    public function getCount()
    {
        return $this->count;
    }
    
    /**
     * Increases count
     * 
     * @return Word
     */
    public function incCount()
    {
        $this->count++;
        
        return $this;
    }

    /**
     * Add similarities
     *
     * @param \MM\SoapBundle\Entity\Word $similarities
     * @return Word
     */
    public function addSimilarity(\MM\SoapBundle\Entity\Word $similarities)
    {
        $this->similarities[] = $similarities;

        return $this;
    }

    /**
     * Remove similarities
     *
     * @param \MM\SoapBundle\Entity\Word $similarities
     */
    public function removeSimilarity(\MM\SoapBundle\Entity\Word $similarities)
    {
        $this->similarities->removeElement($similarities);
    }

    /**
     * Get similarities
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSimilarities()
    {
        return $this->similarities;
    }

    /**
     * Add similars
     *
     * @param \MM\SoapBundle\Entity\Word $similars
     * @return Word
     */
    public function addSimilar(\MM\SoapBundle\Entity\Word $similars)
    {
        $this->similars[] = $similars;

        return $this;
    }

    /**
     * Remove similars
     *
     * @param \MM\SoapBundle\Entity\Word $similars
     */
    public function removeSimilar(\MM\SoapBundle\Entity\Word $similars)
    {
        $this->similars->removeElement($similars);
    }

    /**
     * Get similars
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getSimilars()
    {
        return $this->similars;
    }

    /**
     * Set website
     *
     * @param \MM\SoapBundle\Entity\Website $website
     * @return Word
     */
    public function setWebsite(\MM\SoapBundle\Entity\Website $website = null)
    {
        $this->website = $website;

        return $this;
    }

    /**
     * Get website
     *
     * @return \MM\SoapBundle\Entity\Website 
     */
    public function getWebsite()
    {
        return $this->website;
    }
}
