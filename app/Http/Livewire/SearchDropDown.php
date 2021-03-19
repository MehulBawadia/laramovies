<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Http;

class SearchDropDown extends Component
{
    public $search = "";

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) >= 2) {
            $searchResults = Http::withToken(config('services.tmdb.token'))
                                ->get(config('services.tmdb.base_url') . '/search/multi?query=' . $this->search)
                                ->json()['results'];

            $searchResults = collect($searchResults)->unique()->take(10)->map(function ($res) {
                if ($res['media_type'] === 'person') {
                    $link = route('actors.show', $res['id']);
                    $name = $res['name'];
                } elseif ($res['media_type'] === 'tv') {
                    $link = route('tv.show', $res['id']);
                    $name = $res['name'];
                } else {
                    $link = route('movies.show', $res['id']);
                    $name = $res['title'];
                }

                if (in_array($res['media_type'], ['movie', 'tv']) && isset($res['poster_path'])) {
                    $imagePath = "https://image.tmdb.org/t/p/w92/{$res['poster_path']}";
                } elseif ($res['media_type'] === 'person' && isset($res['profile_path'])) {
                    $imagePath = "https://image.tmdb.org/t/p/w92/{$res['profile_path']}";
                } else {
                    $imagePath = "https://via.placeholder.com/50x75";
                }

                return collect($res)->merge([
                    'page_link' => $link,
                    'image_path' => $imagePath,
                    'title_name' => $name,
                ]);
            });
        }

        return view('livewire.search-drop-down', compact('searchResults'));
    }
}
