<?php

namespace App\Models;

use Framework\Core\Model;

class Hike extends Model
{
    protected ?int $id = null;
    protected ?int $user_id = 1;
    protected ?int $mountain_id = 1;
    protected ?string $mountain = null;
    protected ?string $title = null;
    protected ?string $hike_date = null;
    protected ?float $distance = null;
    protected ?int $elevation = null;
    protected ?string $difficulty = 'Stredná';
    protected ?string $gpx_file = null;
    protected ?string $status = 'Absolvovaná';
    protected ?int $is_public = 1;
    protected ?string $description = null;

    public function getId(): ?int { return $this->id; }
    public function getUserId(): ?int { return $this->user_id; }
    public function setUserId(int $user_id): void { $this->user_id = $user_id; }
    public function getMountainId(): ?int { return $this->mountain_id; }
    public function setMountainId(int $mountain_id): void { $this->mountain_id = $mountain_id; }
    public function getMountain(): ?string { return $this->mountain; }
    public function setMountain(string $mountain): void { $this->mountain = $mountain; }
    public function getTitle(): ?string { return $this->title; }
    public function setTitle(string $title): void { $this->title = $title; }
    public function getHikeDate(): ?string { return $this->hike_date; }
    public function setHikeDate(string $hike_date): void { $this->hike_date = $hike_date; }

    public function getFormattedDate(): string
    {
        if (!$this->hike_date) return '';
        $ts = strtotime($this->hike_date);
        return $ts ? date('d. m. Y', $ts) : $this->hike_date;
    }

    public function getDistance(): ?float { return $this->distance; }
    public function setDistance(float $distance): void { $this->distance = $distance; }
    public function getElevation(): ?int { return $this->elevation; }
    public function setElevation(int $elevation): void { $this->elevation = $elevation; }
    public function getDifficulty(): ?string { return $this->difficulty; }
    public function setDifficulty(string $difficulty): void { $this->difficulty = $difficulty; }
    public function getGpxFile(): ?string { return $this->gpx_file; }
    public function setGpxFile(string $gpx_file): void { $this->gpx_file = $gpx_file; }
    public function getStatus(): ?string { return $this->status; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function getIsPublic(): ?int { return $this->is_public; }
    public function setIsPublic(int $is_public): void { $this->is_public = $is_public; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): void { $this->description = $description; }

    // Praktická metóda: Vytiahne fotky tejto túry z DB
    public function getPhotos(): array
    {
        if (!$this->id) return [];
        return HikePhoto::getAll('hike_id = ?', [$this->id]);
    }

    // Praktická metóda: Vytiahne recenzie a reporty podmienok tejto túry
    public function getRatings(): array
    {
        if (!$this->id) return [];
        return Rating::getAll('hike_id = ?', [$this->id]);
    }

    // Praktická metóda: Vypočíta priemerné hodnotenie z DB
    public function getAverageRating(): float
    {
        $ratings = $this->getRatings();
        if (empty($ratings)) return 0.0;
        $sum = 0;
        foreach ($ratings as $r) {
            $sum += (int)$r->getStars();
        }
        return round($sum / count($ratings), 1);
    }

    // Praktická metóda: Odhad času výstupu podľa Naismithovho pravidla (5 km/h + 1h na každých 600 m prevýšenia)
    public function getEstimatedDuration(): string
    {
        $hours = ((float)$this->distance / 4.5) + ((int)$this->elevation / 550);
        $h = (int)floor($hours);
        $m = (int)round(($hours - $h) * 60);
        return "{$h} h {$m} min";
    }
}