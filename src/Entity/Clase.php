<?php

namespace App\Entity;

use App\Repository\ClaseRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClaseRepository::class)]
class Clase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $type = null;

    #[ORM\OneToMany(mappedBy: 'TipoDeClases', targetEntity: Formulario::class)]
    private Collection $formularios;

    public function __construct()
    {
        $this->formularios = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function __ToString()
    {
        return $this->getType();
    }

    public function setType(?string $type): self
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @return Collection<int, Formulario>
     */
    public function getFormularios(): Collection
    {
        return $this->formularios;
    }

    public function addFormulario(Formulario $formulario): self
    {
        if (!$this->formularios->contains($formulario)) {
            $this->formularios->add($formulario);
            $formulario->setTipoDeClases($this);
        }

        return $this;
    }

    public function removeFormulario(Formulario $formulario): self
    {
        if ($this->formularios->removeElement($formulario)) {
            // set the owning side to null (unless already changed)
            if ($formulario->getTipoDeClases() === $this) {
                $formulario->setTipoDeClases(null);
            }
        }

        return $this;
    }
}
