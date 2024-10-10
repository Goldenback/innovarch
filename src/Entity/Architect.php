<?php

namespace App\Entity;

use App\Repository\ArchitectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArchitectRepository::class)]
class Architect extends User
{
	/**
	 * @var Collection<int, Client>
	 */
	#[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'architect')]
	private Collection $clients;

    /**
     * @var Collection<int, Project>
     */
    #[ORM\OneToMany(targetEntity: Project::class, mappedBy: 'architect', orphanRemoval: true)]
    private Collection $projects;

	public function __construct()
	{
		$this->clients = new ArrayCollection();
        $this->projects = new ArrayCollection();
	}

	/**
	 * @return Collection<int, Client>
	 */
	public function getClients(): Collection
	{
		return $this->clients;
	}

	public function addClient(Client $client): static
	{
		if (!$this->clients->contains($client)) {
			$this->clients->add($client);
			$client->setArchitect($this);
		}

		return $this;
	}

	public function removeClient(Client $client): static
	{
		if ($this->clients->removeElement($client)) {
			// set the owning side to null (unless already changed)
			if ($client->getArchitect() === $this) {
				$client->setArchitect(null);
			}
		}

		return $this;
	}

    /**
     * @return Collection<int, Project>
     */
    public function getProjects(): Collection
    {
        return $this->projects;
    }

    public function addProject(Project $project): static
    {
        if (!$this->projects->contains($project)) {
            $this->projects->add($project);
            $project->setArchitect($this);
        }

        return $this;
    }

    public function removeProject(Project $project): static
    {
        if ($this->projects->removeElement($project)) {
            // set the owning side to null (unless already changed)
            if ($project->getArchitect() === $this) {
                $project->setArchitect(null);
            }
        }

        return $this;
    }
}
