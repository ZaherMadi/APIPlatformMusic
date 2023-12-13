<?php
namespace App\Dto;

class SongDto {
    public int $id;
    public string $title;
    public int $length;

    public function __construct(int $id, string $title, int $length) {
        $this->id = $id;
        $this->title = $title;
        $this->length = $length;
    }
}
