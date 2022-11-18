<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proj
 *
 * @ORM\Table(name="proj", indexes={@ORM\Index(name="fk_PROJ", columns={"EMPNO"})})
 * @ORM\Entity
 */
class Proj
{
    /**
     * @var int
     *
     * @ORM\Column(name="PROJID", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="STARTDATE", type="date", nullable=false)
     */
    private $startdate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="ENDDATE", type="date", nullable=false)
     */
    private $enddate;

    /**
     * @var \Emp
     *
     * @ORM\ManyToOne(targetEntity="Emp")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="EMPNO", referencedColumnName="EMPNO")
     * })
     */
    private $empno;


}
