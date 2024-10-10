<?php

namespace App\Entity;

use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	#[ORM\ManyToOne(inversedBy: 'clients')]
	private ?Architect $architect = null;

	public function getArchitect(): ?Architect
	{
		return $this->architect;
	}

	public function setArchitect(?Architect $architect): static
	{
		$this->architect = $architect;

		return $this;
	}
}
