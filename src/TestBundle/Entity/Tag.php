<?php

namespace TestBundle\Entity;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Tag
 *
 * @author ameni
 */
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="tag",uniqueConstraints={@ORM\UniqueConstraint(name="tag_idx", columns={"name"})})
 */
class Tag {

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Tag", inversedBy="sonTag")
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
     */
    private $parentTag;

    /**
     * @ORM\OneToMany(targetEntity="Tag", mappedBy="parentTag")
     */
    private $sonTag;

    /**
     * @ORM\ManyToMany(targetEntity="Person", mappedBy="tags")
     */
    private $persons;

    public function __construct() {
        $this->persons = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sonTag = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Tag
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Add person
     *
     * @param \TestBundle\Entity\Person $person
     *
     * @return Tag
     */
    public function addPerson(\TestBundle\Entity\Person $person) {
        $this->persons[] = $person;

        return $this;
    }

    /**
     * Remove person
     *
     * @param \TestBundle\Entity\Person $person
     */
    public function removePerson(\TestBundle\Entity\Person $person) {
        $this->persons->removeElement($person);
    }

    /**
     * Get persons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPersons() {
        return $this->persons;
    }


    /**
     * Set parentTag
     *
     * @param \TestBundle\Entity\Tag $parentTag
     *
     * @return Tag
     */
    public function setParentTag(\TestBundle\Entity\Tag $parentTag = null)
    {
        $this->parentTag = $parentTag;

        return $this;
    }

    /**
     * Get parentTag
     *
     * @return \TestBundle\Entity\Tag
     */
    public function getParentTag()
    {
        return $this->parentTag;
    }

    /**
     * Add sonTag
     *
     * @param \TestBundle\Entity\Tag $sonTag
     *
     * @return Tag
     */
    public function addSonTag(\TestBundle\Entity\Tag $sonTag)
    {
        $this->sonTag[] = $sonTag;

        return $this;
    }

    /**
     * Remove sonTag
     *
     * @param \TestBundle\Entity\Tag $sonTag
     */
    public function removeSonTag(\TestBundle\Entity\Tag $sonTag)
    {
        $this->sonTag->removeElement($sonTag);
    }

    /**
     * Get sonTag
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSonTag()
    {
        return $this->sonTag;
    }
    public function __toString() {
        return $this->name;
    }
}
