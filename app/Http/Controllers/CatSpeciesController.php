<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class CatSpeciesController extends Controller
{
    protected $key;

    public function __construct()
    {
        $this->key = 'route_' . Str::slug(\request()->url());
    }

    public function showThreeCats()
    {
        if (Cache::has($this->key)) {
            $cats = Cache::get($this->key);
        } else {
            $cats = $this->getSelectedCats();
            Cache::put($this->key, $cats, 60);
        }

        return view('cats', ['cats' => $cats]);
    }

    private function getSelectedCats()
    {
        $allCats = $this->getCatsArray();

        $count = count($allCats);

        $cats[1] = $allCats[rand(0, $count)];
        $cats[2] = $allCats[rand(0, $count)];

        while ($cats[2] === $cats[1]) {
            $cats[2] = $allCats[rand(0, $count)];
        }

        $cats[3] = $allCats[rand(0, $count)];

        while ($cats[3] === $cats[1] || $cats[3] === $cats[2]) {
            $cats[3] = $allCats[rand(0, $count)];
        }

        return $cats;
    }

    private function getCatsArray()
    {
        $file = fopen(storage_path('app\species\cats.txt'), 'r');

        $cats = [];

        while (feof($file) === false) {
            $cats[] = fgets($file);
        }

        fclose($file);

        return $cats;
    }
}
