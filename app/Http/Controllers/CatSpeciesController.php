<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CatSpeciesController extends Controller
{
    public function showThreeCats()
    {
        $allCats = $this->getCatsArray();
        $count = 2;

        $cat1 = $allCats[rand(0, $count)];
        $cat2 = $allCats[rand(0, $count)];

        while ($cat2 === $cat1) {
            $cat2 = $allCats[rand(0, $count)];
        }

        $cat3 = $allCats[rand(0, $count)];

        while ($cat3 === $cat1 || $cat3 === $cat2) {
            $cat3 = $allCats[rand(0, $count)];
        }

        return view('cats', ['cat1' => $cat1, 'cat2' => $cat2, 'cat3' => $cat3]);
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
