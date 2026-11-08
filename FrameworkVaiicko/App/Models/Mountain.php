<?php

namespace App\Models;

use Framework\Core\Model;

class Mountain extends Model
{
    protected ?int $id = null;
    protected ?string $name = null;
    protected ?string $highest_peak = null;
    protected ?int $elevation = null;
    protected ?string $description = null;

    public function getId(): ?int { return $this->id; }
    public function getName(): ?string { return $this->name; }
    public function setName(string $name): void { $this->name = $name; }
    public function getHighestPeak(): ?string { return $this->highest_peak; }
    public function setHighestPeak(string $highest_peak): void { $this->highest_peak = $highest_peak; }
    public function getElevation(): ?int { return $this->elevation; }
    public function setElevation(int $elevation): void { $this->elevation = $elevation; }
    public function getDescription(): ?string { return $this->description; }
    public function setDescription(?string $description): void { $this->description = $description; }

    // Praktická metóda: Zistí, koľko túr v databáze patrí do tohto pohoria
    public function getHikeCount(): int
    {
        if (!$this->id) return 0;
        return count(Hike::getAll('mountain_id = ?', [$this->id]));
    }
}