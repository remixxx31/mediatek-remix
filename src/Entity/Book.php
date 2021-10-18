<?php

namespace App\Entity;

use App\Entity\Kind;
use App\Entity\Author;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookRepository;

/**
 * @ORM\Entity(repositoryClass=BookRepository::class)
 */
class Book
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity=Author::class)
     */
    private $authorbook;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=4, nullable=true)
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity=Kind::class, inversedBy="books")
     */
    private $category;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cover;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthorbook(): ?Author
    {
        return $this->authorbook;
    }

    public function setAuthorbook(?Author $authorbook): self
    {
        $this->authorbook = $authorbook;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getYear(): ?string
    {
        return $this->year;
    }

    public function setYear(?string $year): self
    {
        $this->year = $year;

        return $this;
    }

    public function getCategory(): ?Kind
    {
        return $this->category;
    }

    public function setCategory(?Kind $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCover(): ?string
    {
        return $this->cover;
    }

    public function setCover(?string $cover): self
    {
        $this->cover = $cover;

        return $this;
    }
    
}
