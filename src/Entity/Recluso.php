<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Recluso
 *
 * @ORM\Table(name="recluso", indexes={@ORM\Index(name="IDX_9AE539F4D8D4F299", columns={"id_pabellon"})})
 * @ORM\Entity
 * @ORM\Entity(repositoryClass=App\Repository\ReclusoRepository::class)
 */
class Recluso
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_recluso", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="recluso_id_recluso_seq", allocationSize=1, initialValue=1)
     */
    private $idRecluso;

    /**
     * @var string|null
     *
     * @ORM\Column(name="identificacion", type="string", length=12, nullable=true)
     */
    private $identificacion;

    /**
     * @var array|null
     *
     * @ORM\Column(name="delitos", type="json", nullable=true)
     */
    private $delitos;

    /**
     * @var int|null
     *
     * @ORM\Column(name="sentencia", type="integer", nullable=true)
     */
    private $sentencia;

    /**
     * @var bool|null
     *
     * @ORM\Column(name="ficha_ingreso", type="boolean", nullable=true)
     */
    private $fichaIngreso;

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

    public function getIdRecluso(): ?int
    {
        return $this->idRecluso;
    }

    public function getIdentificacion(): ?string
    {
        return $this->identificacion;
    }

    public function setIdentificacion(?string $identificacion): self
    {
        $this->identificacion = $identificacion;

        return $this;
    }

    public function getDelitos(): array
    {
        return $this->delitos;
    }

    public function setDelitos(?array $delitos): self
    {
        $this->delitos = $delitos;

        return $this;
    }

    public function getSentencia(): ?int
    {
        return $this->sentencia;
    }

    public function setSentencia(?int $sentencia): self
    {
        $this->sentencia = $sentencia;

        return $this;
    }

    public function isFichaIngreso(): ?bool
    {
        return $this->fichaIngreso;
    }

    public function setFichaIngreso(?bool $fichaIngreso): self
    {
        $this->fichaIngreso = $fichaIngreso;

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
        return sprintf($this->idRecluso." ".$this->identificacion );
    }


}
