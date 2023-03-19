<?php

namespace App\Entity;

use App\Repository\FormularioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FormularioRepository::class)]
class Formulario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nombre = null;

    #[ORM\Column(length: 255)]
    private ?string $Telefono = null;

    #[ORM\ManyToOne(inversedBy: 'formularios')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Clase $TipoDeClases = null;

   

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->Telefono;
    }

    public function setTelefono(string $Telefono): self
    {
        $this->Telefono = $Telefono;

        return $this;
    }

    public function getTipoDeClases(): ?Clase
    {
        return $this->TipoDeClases;
    }

    public function setTipoDeClases(?Clase $TipoDeClases): self
    {
        $this->TipoDeClases = $TipoDeClases;

        return $this;
    }

}
