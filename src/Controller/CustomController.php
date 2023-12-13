<?php 
namespace App\Controller;

use App\Repository\ArtistRepository;
use App\Repository\AlbumRepository;
use App\Repository\SongRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CustomController
{
    private $artistRepository;
    private $albumRepository;
    private $songRepository;

    public function __construct(ArtistRepository $artistRepository, AlbumRepository $albumRepository, SongRepository $songRepository)
    {
        $this->artistRepository = $artistRepository;
        $this->albumRepository = $albumRepository;
        $this->songRepository = $songRepository;
    }

    /**
     * @Route("/artist/{artistId}/album/{albumId}/song/{songId}", name="custom_endpoint")
     */
    public function customAction($artistId, $albumId, $songId)
    {
        // Récupérer l'artiste
        $artist = $this->artistRepository->find($artistId);
        if (!$artist) {
            return new Response('Artiste non trouvé', Response::HTTP_NOT_FOUND);
        }
    
        // Récupérer l'album
        $album = $this->albumRepository->findOneBy(['id' => $albumId, 'artist' => $artist]);
        if (!$album) {
            return new Response('Album non trouvé', Response::HTTP_NOT_FOUND);
        }
    
        // Récupérer la chanson
        $song = $this->songRepository->findOneBy(['id' => $songId, 'album' => $album]);
        if (!$song) {
            return new Response('Chanson non trouvée', Response::HTTP_NOT_FOUND);
        }
    
        // Construire la réponse (par exemple, un array ou un DTO)
        $responseData = [
            'artist' => [
                'id' => $artist->getId(),
                'name' => $artist->getName(),
                'style' => $artist->getStyle(),
            ],
            'album' => [
                'id' => $album->getId(),
                'title' => $album->getTitle(),
                'date' => $album->getDate()->format('Y-m-d'),
            ],
            'song' => [
                'id' => $song->getId(),
                'title' => $song->getTitle(),
                'length' => $song->getLength(),
            ],
        ];

    
        return new Response($responseData, Response::HTTP_OK);
    }
    
}
