<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pabellon
 *
 * @ORM\Table(name="pabellon")
 * @ORM\Entity
 * @ORM\Entity(repositoryClass=App\Repository\PabellonRepository::class)
 */
class Pabellon
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_pabellon", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="pabellon_id_pabellon_seq", allocationSize=1, initialValue=1)
     */
    private $idPabellon;

    /**
     * @var string|null
     *
     * @ORM\Column(name="nombre", type="string", length=50, nullable=true)
     */
    private $nombre;

    /**
     * @var string|null
     *
     * @ORM\Column(name="estado", type="string", length=1, nullable=true)
     */
    private $estado;

    public function getIdPabellon(): ?int
    {
        return $this->idPabellon;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): self
    {
        $this->nombre = $nombre;

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
    public function __toString()
    {
        return sprintf($this->idPabellon." ".$this->nombre );
    }



}
