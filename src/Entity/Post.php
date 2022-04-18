<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: PostRepository::class)]
#[ApiResource(
        collectionOperations: ['get' => ['normalization_context' => ['groups' => 'post:list']]],
    itemOperations: ['get' => ['normalization_context' => ['groups' => 'post:item']]],
    order: ['id' => 'ASC',],
    paginationEnabled: false,
)]
class Post
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['post:list', 'post:item'])]
    private int $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(['post:list', 'post:item'])]
    private int $userId;

    #[ORM\Column(type: 'string', length: 100)]
    #[Groups(['post:list', 'post:item'])]
    private string $title;

    #[ORM\Column(type: 'text', length: 255)]
    #[Groups(['post:list', 'post:item'])]
    private string $body;

    #[ORM\Column(type: 'string', length: 30, nullable: true)]
    #[Groups(['post:list', 'post:item'])]
    private string $authorName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserId(): ?int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): self
    {
        $this->userId = $userId;

        return $this;
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

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getAuthorName(): ?string
    {
        return $this->authorName;
    }

    public function setAuthorName(string $authorName): self
    {
        $this->authorName = $authorName;

        return $this;
    }

}
