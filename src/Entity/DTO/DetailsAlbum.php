<?php

namespace App\Entity\DTO;

use DateTime;
use Doctrine\ORM\Mapping\Id;
use Twig\Node\CheckToStringNode;

class DetailsAlbum {
    public int $id;
    public string $title;
    public string $link= "http://localhost:8000/api/albums/";
    public DateTime $date;
    public function __construct(int $id, string $title, DateTime $date) {
        $this->id = $id;
        $this->title = $title;
        $this->date = $date;
        $this->link= "http://localhost:8000/api/albums/" . $id;


        // $this->link = $link;
    }
}
