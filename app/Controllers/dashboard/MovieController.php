<?php namespace App\Controllers\dashboard;

use App\Controllers\BaseController;
use App\Models\MovieModel;

class MovieController extends BaseController {

    public function index() {

        $movie = new MovieModel();

        $dataHeader = [
            'title' => 'Listado de películas'
        ];

        /*$data = [
            'movies' => array(0, 1, 2, 3, 4)
        ];*/

//        var_dump($movie->asObject()->findAll());

        $data = [
            'movies' => $movie->asObject()->findAll(10, 10)
//            'movies' => $movie->asObject()->findAll(10, 10)
        ];

        echo view("dashboard/templates/header", $dataHeader);
        echo view("dashboard/movie/index", $data);
        echo view("dashboard/templates/footer");
    }

    public function show() {

        $movie = new MovieModel();

        var_dump($movie->get(7)->id);


    }

}