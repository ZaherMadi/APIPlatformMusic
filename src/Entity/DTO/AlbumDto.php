namespace App\Dto;

class AlbumDto {
    public int $id;
    public string $title;
    public string $releaseDate;

    public function __construct(int $id, string $title, string $releaseDate) {
        $this->id = $id;
        $this->title = $title;
        $this->releaseDate = $releaseDate;
    }
}
