<?php

namespace App\Entity;

use App\Repository\ProjectRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProjectRepository::class)]
class Project
{
	#[ORM\Id]
	#[ORM\GeneratedValue]
	#[ORM\Column]
	private ?int $id = null;

	#[ORM\ManyToOne(inversedBy: 'projects')]
	#[ORM\JoinColumn(nullable: false)]
	private ?Architect $architect = null;

	#[ORM\ManyToOne(inversedBy: 'projects')]
	private ?Client $client = null;

	#[ORM\Column(length: 255)]
	private ?string $title = null;

	#[ORM\Column(type: Types::TEXT, nullable: true)]
	private ?string $description = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?ProjectStatus $status = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $updatedAt = null;

    /**
     * @var Collection<int, Analyse>
     */
    #[ORM\OneToMany(targetEntity: Analyse::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $analyses;

    /**
     * @var Collection<int, Model>
     */
    #[ORM\OneToMany(targetEntity: Model::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $models;

    /**
     * @var Collection<int, CostEstimation>
     */
    #[ORM\OneToMany(targetEntity: CostEstimation::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $costEstimations;

    /**
     * @var Collection<int, EnergySimulation>
     */
    #[ORM\OneToMany(targetEntity: EnergySimulation::class, mappedBy: 'project', orphanRemoval: true)]
    private Collection $energySimulations;

    public function __construct()
    {
        $this->analyses = new ArrayCollection();
        $this->models = new ArrayCollection();
        $this->costEstimations = new ArrayCollection();
        $this->energySimulations = new ArrayCollection();
    }

	#[ORM\JoinColumn(nullable: false)]
	public function getId(): ?int
	{
		return $this->id;
	}

	public function getArchitect(): ?Architect
	{
		return $this->architect;
	}

	public function setArchitect(?Architect $architect): static
	{
		$this->architect = $architect;

		return $this;
	}

	public function getClient(): ?Client
	{
		return $this->client;
	}

	public function setClient(?Client $client): static
	{
		$this->client = $client;

		return $this;
	}

	public function getTitle(): ?string
	{
		return $this->title;
	}

	public function setTitle(string $title): static
	{
		$this->title = $title;

		return $this;
	}

	public function getDescription(): ?string
	{
		return $this->description;
	}

	public function setDescription(?string $description): static
	{
		$this->description = $description;

		return $this;
	}

    public function getStatus(): ?ProjectStatus
    {
        return $this->status;
    }

    public function setStatus(?ProjectStatus $status): static
    {
        $this->status = $status;

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

    /**
     * @return Collection<int, Analyse>
     */
    public function getAnalyses(): Collection
    {
        return $this->analyses;
    }

    public function addAnalysis(Analyse $analysis): static
    {
        if (!$this->analyses->contains($analysis)) {
            $this->analyses->add($analysis);
            $analysis->setProject($this);
        }

        return $this;
    }

    public function removeAnalysis(Analyse $analysis): static
    {
        if ($this->analyses->removeElement($analysis)) {
            // set the owning side to null (unless already changed)
            if ($analysis->getProject() === $this) {
                $analysis->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Model>
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    public function addModel(Model $model): static
    {
        if (!$this->models->contains($model)) {
            $this->models->add($model);
            $model->setProject($this);
        }

        return $this;
    }

    public function removeModel(Model $model): static
    {
        if ($this->models->removeElement($model)) {
            // set the owning side to null (unless already changed)
            if ($model->getProject() === $this) {
                $model->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CostEstimation>
     */
    public function getCostEstimations(): Collection
    {
        return $this->costEstimations;
    }

    public function addCostEstimation(CostEstimation $costEstimation): static
    {
        if (!$this->costEstimations->contains($costEstimation)) {
            $this->costEstimations->add($costEstimation);
            $costEstimation->setProject($this);
        }

        return $this;
    }

    public function removeCostEstimation(CostEstimation $costEstimation): static
    {
        if ($this->costEstimations->removeElement($costEstimation)) {
            // set the owning side to null (unless already changed)
            if ($costEstimation->getProject() === $this) {
                $costEstimation->setProject(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, EnergySimulation>
     */
    public function getEnergySimulations(): Collection
    {
        return $this->energySimulations;
    }

    public function addEnergySimulation(EnergySimulation $energySimulation): static
    {
        if (!$this->energySimulations->contains($energySimulation)) {
            $this->energySimulations->add($energySimulation);
            $energySimulation->setProject($this);
        }

        return $this;
    }

    public function removeEnergySimulation(EnergySimulation $energySimulation): static
    {
        if ($this->energySimulations->removeElement($energySimulation)) {
            // set the owning side to null (unless already changed)
            if ($energySimulation->getProject() === $this) {
                $energySimulation->setProject(null);
            }
        }

        return $this;
    }
}
