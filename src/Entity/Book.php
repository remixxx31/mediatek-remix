<?php

namespace App\Entity;

use DateInterval;
use App\Entity\Kind;
use App\Entity\User;
use App\Entity\Author;
use DateTimeInterface;
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
     * @ORM\ManyToOne(targetEntity=Author::class, inversedBy="books")
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

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $available;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="books_holded"),
     */
    private $holder;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $loan_date;





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

    public function getAvailable(): ?bool
    {
        return $this->available;
    }

    public function setAvailable(bool $available): self
    {
        $this->available = $available;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getHolder(): ?User
    {
        return $this->holder;
    }

    public function setHolder(?User $holder): self
    {
        $this->holder = $holder;

        return $this;
    }

    public function __toString()
    {
        return $this->title;
    }

    public function getLoanDate(): ?\DateTimeInterface
    {
        return $this->loan_date;
    }

    public function setLoanDate(?\DateTimeInterface $loan_date): self
    {
        $this->loan_date = $loan_date;

        return $this;
    }
    //méthode date de retour 
    public function getReturnLoanDate(): ?\DateTimeInterface
    {
        if ($this->loan_date !== null) {
            $dateString = $this->loan_date->format('Y-m-d');
            // 2021-11-10
            $date = new \DateTime($dateString);
            // ObjectDateTime{2021-11-10}

            // $date = clone $this->loan_date;
            $date->add(new DateInterval('P30D'));
            return $date;
        }
        return null;
    }
}
