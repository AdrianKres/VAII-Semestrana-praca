<?php

namespace App\Models;

use Framework\Core\Model;

class Rating extends Model
{
    protected ?int $id = null;
    protected ?int $hike_id = null;
    protected ?string $author_name = 'Turista';
    protected ?int $stars = 5;
    protected ?string $comment = null;
    protected ?string $created_at = null;

    public function getId(): ?int { return $this->id; }
    public function getHikeId(): ?int { return $this->hike_id; }
    public function setHikeId(int $hike_id): void { $this->hike_id = $hike_id; }
    public function getAuthorName(): ?string { return $this->author_name; }
    public function setAuthorName(string $author_name): void { $this->author_name = $author_name; }
    public function getStars(): ?int { return $this->stars; }
    public function setStars(int $stars): void { $this->stars = max(1, min(5, $stars)); }
    public function getComment(): ?string { return $this->comment; }
    public function setComment(?string $comment): void { $this->comment = $comment; }
    public function getCreatedAt(): ?string { return $this->created_at; }
    public function setCreatedAt(string $created_at): void { $this->created_at = $created_at; }
}