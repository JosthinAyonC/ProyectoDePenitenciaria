<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Celda
 *
 * @ORM\Table(name="celda", indexes={@ORM\Index(name="IDX_6EA13098D8D4F299", columns={"id_pabellon"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass=App\Repository\CeldaRepository::class)
 */
class Celda
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_celda", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="celda_id_celda_seq", allocationSize=1, initialValue=1)
     */
    private $idCelda;

    /**
     * @var int|null
     *
     * @ORM\Column(name="capacidad", type="integer", nullable=true)
     */
    private $capacidad;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    /**
     * @var \App\Entity\Pabellon
     *
     * @ORM\ManyToOne(targetEntity="Pabellon")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_pabellon", referencedColumnName="id_pabellon")
     * })
     */
    private $idPabellon;

    public function getIdCelda(): ?int
    {
        return $this->idCelda;
    }

    public function getCapacidad(): ?int
    {
        return $this->capacidad;
    }

    public function setCapacidad(?int $capacidad): self
    {
        $this->capacidad = $capacidad;

        return $this;
    }

    public function getEstado(): ?string
    {
        return $this->estado;
    }

    public function setEstado(?string $estado): self
    {
        $this->estado = $estado;

        return $this;
    }

    public function getIdPabellon(): ?Pabellon
    {
        return $this->idPabellon;
    }

    public function setIdPabellon(?Pabellon $idPabellon): self
    {
        $this->idPabellon = $idPabellon;

        return $this;
    }
    public function __toString()
    {
        return sprintf($this->idCelda." ".$this->capacidad );
    }


}
