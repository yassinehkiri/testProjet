<?php

namespace App\Entity;

use App\Repository\DeptRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=DeptRepository::class)
 */

/**
 * Dept
 *
 * @ORM\Table(name="dept")
 * @ORM\Entity
 */
class Dept
{
    /**
     * @var int
     *
     * @ORM\Column(name="DEPTNO", type="integer", nullable=false, options={"comment"="Department's identification number"})
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $deptno;

    /**
     * @var string
     *
     * @ORM\Column(name="DNAME", type="string", length=20, nullable=false, options={"comment"="Name of the current department"})
     */
    private $dname;

    /**
     * @var string
     *
     * @ORM\Column(name="LOC", type="string", length=20, nullable=false, options={"comment"="Location of the current department"})
     */
    private $loc;

    public function getdeptno(): ?int
    {
        return $this->deptno;
    }

    public function setdeptno(string $deptno): self
    {
        $this->deptno = $deptno;

        return $this;
    }
    
    public function getdname(): ?string
    {
        return $this->dname;
    }
    
    public function setdname(string $dname): self
    {
        $this->dname = $dname;

        return $this;
    }
 
    public function getloc(): ?string
    {
        return $this->loc;
    }
    
    public function setloc(string $loc): self
    {
        $this->loc = $loc;

        return $this;
    }





}
