<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Support\Facades\Http;

class ViewMoviesTest extends TestCase
{
    /** @test */
    public function the_main_page_shows_correct_info()
    {
        $this->withoutExceptionHandling();
        Http::fake([
            config('services.tmdb.base_url') . '/movie/popular' => $this->fakePopularMovies(),
            config('services.tmdb.base_url') . '/movie/now_playing' => $this->fakeNowPlayingMovies(),
            config('services.tmdb.base_url') . '/genre/movie/list' => $this->fakeGenres(),
        ]);

        $response = $this->get(route('movies.index'));

        $response->assertOk();
        $response->assertSeeText('Popular Movies');
        $response->assertSeeText('Fake Movie');

        $response->assertSeeText('Comedy, Crime, Thriller');

        $response->assertSeeText('Now Playing');
        $response->assertSeeText('Now Playing Fake Movie');
    }

    /** @test */
    public function the_movie_details_page_shows_correct_info()
    {
        $this->withoutExceptionHandling();

        Http::fake([
            config('services.tmdb.base_url') . '/movie/*' => $this->fakeSingleMovie(),
        ]);

        $response = $this->get(route('movies.show', 12345));
        $response->assertSee('Fake Jumanji');
        $response->assertSee('Jeanne McCarthy');
        $response->assertSee('Casting Director');
        $response->assertSee('Dwayne Johnson');
    }

    private function fakePopularMovies()
    {
        return Http::response([
            'results' => [[
                "adult" => false,
                "backdrop_path" => "/yR27bZPIkNhpGEIP3jKV2EifTgo.jpg",
                "genre_ids" => [
                    0 => 16,
                    1 => 10751,
                ],
                "id" => 755812,
                "original_language" => "fr",
                "original_title" => "Fake Movie",
                "overview" => "During a school field trip, Ladybug and Cat Noir meet the American superheroes whom they have to save from an akumatised super-villain. They discover that Miraculous exist in the United States too.",
                "popularity" => 725.881,
                "poster_path" => "/kIHgjAkuzvKBnmdstpBOo4AfZah.jpg",
                "release_date" => "2020-09-26",
                "title" => "Fake Movie",
                "video" => false,
                "vote_average" => 8.4,
                "vote_count" => 485,
            ]],
        ], 200);
    }

    private function fakeNowPlayingMovies()
    {
        return Http::response([
            'results' => [
                [
                    "adult" => false,
                    "backdrop_path" => "/vX5JtEcumMQvMCLVcIqfetc7hdg.jpg",
                    "genre_ids" => [
                        0 => 35,
                        1 => 80,
                        2 => 53,
                    ],
                    "id" => 601666,
                    "original_language" => "en",
                    "original_title" => "I Care a Lot",
                    "overview" => "A court-appointed legal guardian defrauds her older clients and traps them under her care. But her latest mark comes with some unexpected baggage.",
                    "popularity" => 240.848,
                    "poster_path" => "/gKnhEsjNefpKnUdAkn7INzIFLSu.jpg",
                    "release_date" => "2021-02-19",
                    "title" => "Now Playing Fake Movie",
                    "video" => false,
                    "vote_average" => 6.8,
                    "vote_count" => 920,
                ]
            ]
        ], 200);
    }

    public function fakeGenres()
    {
        return Http::response([
            'genres' => [
                [
                  "id" => 28,
                  "name" => "Action"
                ],
                [
                  "id" => 12,
                  "name" => "Adventure"
                ],
                [
                  "id" => 16,
                  "name" => "Animation"
                ],
                [
                  "id" => 35,
                  "name" => "Comedy"
                ],
                [
                  "id" => 80,
                  "name" => "Crime"
                ],
                [
                  "id" => 99,
                  "name" => "Documentary"
                ],
                [
                  "id" => 18,
                  "name" => "Drama"
                ],
                [
                  "id" => 10751,
                  "name" => "Family"
                ],
                [
                  "id" => 14,
                  "name" => "Fantasy"
                ],
                [
                  "id" => 36,
                  "name" => "History"
                ],
                [
                  "id" => 27,
                  "name" => "Horror"
                ],
                [
                  "id" => 10402,
                  "name" => "Music"
                ],
                [
                  "id" => 9648,
                  "name" => "Mystery"
                ],
                [
                  "id" => 10749,
                  "name" => "Romance"
                ],
                [
                  "id" => 878,
                  "name" => "Science Fiction"
                ],
                [
                  "id" => 10770,
                  "name" => "TV Movie"
                ],
                [
                  "id" => 53,
                  "name" => "Thriller"
                ],
                [
                  "id" => 10752,
                  "name" => "War"
                ],
                [
                  "id" => 37,
                  "name" => "Western"
                ],
            ]
        ], 200);
    }

    public function fakeSingleMovie()
    {
        return Http::response([
            "adult" => false,
            "backdrop_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
            "genres" => [
                ["id" => 28, "name" => "Action"],
                ["id" => 12, "name" => "Adventure"],
                ["id" => 35, "name" => "Comedy"],
                ["id" => 14, "name" => "Fantasy"],
            ],
            "homepage" => "http://jumanjimovie.com",
            "id" => 12345,
            "overview" => "As the gang return to Jumanji to rescue one of their own, they discover that nothing is as they expect. The players will have to brave parts unknown and unexplored.",
            "poster_path" => "/bB42KDdfWkOvmzmYkmK58ZlCa9P.jpg",
            "release_date" => "2019-12-04",
            "runtime" => 123,
            "title" => "Fake Jumanji: The Next Level",
            "vote_average" => 6.8,
            "credits" => [
                "cast" => [
                    [
                        "cast_id" => 2,
                        "character" => "Dr. Smolder Bravestone",
                        "credit_id" => "5aac3960c3a36846ea005147",
                        "gender" => 2,
                        "id" => 18918,
                        "name" => "Dwayne Johnson",
                        "order" => 0,
                        "profile_path" => "/kuqFzlYMc2IrsOyPznMd1FroeGq.jpg",
                    ]
                ],
                "crew" => [
                    [
                        "credit_id" => "5d51d4ff18b75100174608d8",
                        "department" => "Production",
                        "gender" => 1,
                        "id" => 546,
                        "job" => "Casting Director",
                        "name" => "Jeanne McCarthy",
                        "profile_path" => null,
                    ]
                ]
            ],
            "videos" => [
                "results" => [
                    [
                        "id" => "5d1a1a9b30aa3163c6c5fe57",
                        "iso_639_1" => "en",
                        "iso_3166_1" => "US",
                        "key" => "rBxcF-r9Ibs",
                        "name" => "JUMANJI: THE NEXT LEVEL - Official Trailer (HD)",
                        "site" => "YouTube",
                        "size" => 1080,
                        "type" => "Trailer",
                    ]
                ]
            ],
            "images" => [
                "backdrops" => [
                    [
                        "aspect_ratio" => 1.7777777777778,
                        "file_path" => "/hreiLoPysWG79TsyQgMzFKaOTF5.jpg",
                        "height" => 2160,
                        "iso_639_1" => null,
                        "vote_average" => 5.388,
                        "vote_count" => 4,
                        "width" => 3840,
                    ]
                ],
                "posters" => [
                    [

                    ]
                ]
            ]
        ], 200);
    }
}
