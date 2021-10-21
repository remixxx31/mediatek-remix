<?php

namespace App\Entity;

use App\Entity\Book;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
* @ORM\Entity(repositoryClass=AuthorRepository::class)
*/
class Author
{
    /**
    * @ORM\Id
    * @ORM\GeneratedValue
    * @ORM\Column(type="integer")
    */
    private $id;
    
    /**
    * @ORM\Column(type="date", nullable=true)
    */
    private $birthdate;
    
    /**
    * @ORM\Column(type="text", nullable=true)
    */
    private $description;
    
    /**
    * @ORM\Column(type="string", length=255 , nullable=false)
    */
    private $name;
    
    /**
    * @ORM\OneToMany(targetEntity=Book::class, mappedBy="authorbook")
    */
    private $books;
    
    public function __construct()
    {
        $this->books = new ArrayCollection();
    }
    
    public function getId(): ?int
    {
        return $this->id;
    }
    
    
    
    public function getBirthdate(): ?\DateTimeInterface
    {
        return $this->birthdate;
    }
    
    public function setBirthdate(?\DateTimeInterface $birthdate): self
    {
        $this->birthdate = $birthdate;
        
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
    
    public function getName(): string
    {
        return $this->name;
    }
    
    public function setName(string $name): self
    {
        $this->name = $name;
        
        return $this;
    }
    
    
    /**
     * @return Collection|Book[]
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }
    
    public function addBook(Book $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books[] = $book;
            $book->setAuthor($this);
        }
        
        return $this;
    }
    
    public function removebook(Book $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }
        
        return $this;
    }
    
    public function __toString(){
        return $this->name;
        
    }
}
