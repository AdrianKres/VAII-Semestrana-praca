<?php

namespace App\Models;

use Framework\Core\Model;

class HikePhoto extends Model
{
    protected static ?string $tableName = 'hike_photos';

    protected ?int $id = null;
    protected ?int $hike_id = null;
    protected ?string $caption = null;
    protected ?string $file_name = 'IMG_TATRY.jpg';
    protected ?string $file_size = '3.2 MB';

    public function getId(): ?int { return $this->id; }
    public function getHikeId(): ?int { return $this->hike_id; }
    public function setHikeId(int $hike_id): void { $this->hike_id = $hike_id; }
    public function getCaption(): ?string { return $this->caption; }
    public function setCaption(string $caption): void { $this->caption = $caption; }
    public function getFileName(): ?string { return $this->file_name; }
    public function setFileName(string $file_name): void { $this->file_name = $file_name; }
    public function getFileSize(): ?string { return $this->file_size; }
    public function setFileSize(string $file_size): void { $this->file_size = $file_size; }
}