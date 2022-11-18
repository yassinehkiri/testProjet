<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Emp
 *
 * @ORM\Table(name="emp", indexes={@ORM\Index(name="fk_MGR", columns={"MGR"}), @ORM\Index(name="fk_DEPTNO", columns={"DEPTNO"})})
 * @ORM\Entity
 */
class Emp
{
    /**
     * @var int
     *
     * @ORM\Column(name="EMPNO", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $empno;

    /**
     * @var string
     *
     * @ORM\Column(name="ENAME", type="string", length=20, nullable=false)
     */
    private $ename;

    /**
     * @var string
     *
     * @ORM\Column(name="JOB", type="string", length=20, nullable=false)
     */
    private $job;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="HIREDATE", type="date", nullable=false)
     */
    private $hiredate;

    /**
     * @var int
     *
     * @ORM\Column(name="SAL", type="integer", nullable=false)
     */
    private $sal;

    /**
     * @var int|null
     *
     * @ORM\Column(name="COMM", type="integer", nullable=true)
     */
    private $comm;

    public $nbOcc;
    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity=Emp::class)
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="MGR", referencedColumnName="EMPNO")
     * })
     */
    private $mgr;

    /**
     * 
     *
     * @ORM\ManyToOne(targetEntity=Dept::class)
     * @ORM\JoinColumns({
     * @ORM\JoinColumn(name="DEPTNO", referencedColumnName="DEPTNO")
     * })
     */
    private $deptno;

    public function getempno(): ?int
    {
        return $this->empno;
    }

    public function setempno(int $empno): self
    {
        $this->empno = $empno;

        return $this;
    }


    public function getename(): ?string
    {
        return $this->ename;
    }

    public function setename(string $ename): self
    {
        $this->ename = $ename;

        return $this;
    }


    public function getjob(): ?string
    {
        return $this->job;
    }

    public function setjob(string $job): self
    {
        $this->job = $job;

        return $this;
    }


    public function gethiredate(): ?\DateTime
    {
        return $this->hiredate;
    }

    public function sethiredate(\DateTime $hiredate): self
    {
        $this->hiredate = $hiredate;

        return $this;
    }


    public function getsal(): ?int
    {
        return $this->sal;
    }

    public function setsal(int $sal): self
    {
        $this->sal = $sal;

        return $this;
    }


    public function getcomm(): ?int
    {
        return $this->comm;
    }

    public function setcomm(int $comm): self
    {
        $this->comm = $comm;

        return $this;
    }


    public function getdeptno(): ?Dept
    {
        return $this->deptno;
    }

    public function setdeptno(?Dept $deptno): self
    {
        $this->deptno = $deptno;

        return $this;
    }

    public function getmgr(): ?Emp
    {
        return $this->mgr;
    }

    public function setmgr(?Emp $mgr): self
    {
        $this->mgr = $mgr;

        return $this;
    }

    









































}
