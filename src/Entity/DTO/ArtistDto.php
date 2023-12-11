namespace App\Dto;

class ArtistDto {
    public int $id;
    public string $name;
    public string $style;

    public function __construct(int $id, string $name, string $style) {
        $this->id = $id;
        $this->name = $name;
        $this->style = $style;
    }
}
