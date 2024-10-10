<?php

namespace App\Entity;

use App\Enum\UserRoleEnum;
use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["architect" => Architect::class, "client" => Client::class])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
class User
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\Column(length: 255)]
	private ?string $firstName = null;

	#[ORM\Column(length: 255)]
	private ?string $lastName = null;

	#[ORM\Column(length: 255)]
	private ?string $email = null;

	#[ORM\Column(length: 255, nullable: true)]
	private ?string $phone = null;

	#[ORM\Column(length: 255)]
	private ?string $password = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $biography = null;

	#[ORM\Column(type: Types::SIMPLE_ARRAY, enumType: UserRoleEnum::class)]
	private array $role = [];

	#[ORM\Column]
	private ?\DateTimeImmutable $createdAt = null;

	#[ORM\Column(nullable: true)]
	private ?\DateTimeImmutable $updatedAt = null;

	#[ORM\Column]
	private ?bool $isActive = null;

	public function getId(): ?int
	{
		return $this->id;
	}

	public function getFirstName(): ?string
	{
		return $this->firstName;
	}

	public function setFirstName(string $firstName): static
	{
		$this->firstName = $firstName;

		return $this;
	}

	public function getLastName(): ?string
	{
		return $this->lastName;
	}

	public function setLastName(string $lastName): static
	{
		$this->lastName = $lastName;

		return $this;
	}

	public function getEmail(): ?string
	{
		return $this->email;
	}

	public function setEmail(string $email): static
	{
		$this->email = $email;

		return $this;
	}

	public function getPhone(): ?string
	{
		return $this->phone;
	}

	public function setPhone(?string $phone): static
	{
		$this->phone = $phone;

		return $this;
	}

	public function getPassword(): ?string
	{
		return $this->password;
	}

	public function setPassword(string $password): static
	{
		$this->password = $password;

		return $this;
	}

	public function getBiography(): ?string
	{
		return $this->biography;
	}

	public function setBiography(?string $biography): static
	{
		$this->biography = $biography;

		return $this;
	}

	/**
	 * @return UserRoleEnum[]
	 */
	public function getRole(): array
	{
		return $this->role;
	}

	public function setRole(array $role): static
	{
		$this->role = $role;

		return $this;
	}

	public function getCreatedAt(): ?\DateTimeImmutable
	{
		return $this->createdAt;
	}

	public function setCreatedAt(\DateTimeImmutable $createdAt): static
	{
		$this->createdAt = $createdAt;

		return $this;
	}

	public function getUpdatedAt(): ?\DateTimeImmutable
	{
		return $this->updatedAt;
	}

	public function setUpdatedAt(?\DateTimeImmutable $updatedAt): static
	{
		$this->updatedAt = $updatedAt;

		return $this;
	}

	public function isActive(): ?bool
	{
		return $this->isActive;
	}

	public function setActive(bool $isActive): static
	{
		$this->isActive = $isActive;

		return $this;
	}
}
