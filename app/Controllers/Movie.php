<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\MovieImageModel;
use App\Models\MovieModel;
use \CodeIgniter\Exceptions\PageNotFoundException;

class Movie extends BaseController {

    public function index() {

        $movie = new MovieModel();

//        var_dump($movie->getAll());

        $data = [
//            'movies' => $movie->asObject()->paginate(10),
//            'movies' => $movie->asObject()
//                ->select('movies.*, categories.name')
//                ->join('categories', 'categories.id = movies.category_id')
//                ->paginate(10),
            'movies' => $movie->getAll()->paginate(10),
            'pager' => $movie->pager,
//            'movies' => $movie->asObject()->findAll(10, 10)
        ];

        $this->_loadDefaultView(
            'Listado de películas',
            $data,
            'index'
        );
    }

    public function new() {

        $category = new CategoryModel();

        $validation = \Config\Services::validation();

        $this->_loadDefaultView(
            'Crear película',
            [
                'validation' => $validation,
                'movie' => new MovieModel(),
                'categories' => $category->asObject()->findAll()
            ],
            'new'
        );

    }

    public function create() {

        $movie = new MovieModel();

//        if ($this->validate([
//            'title' => 'required|min_length[3]|max_length[255]',
//            'description' => 'min_length[3]|max_length[5000]'
//        ]))
        if ($this->validate('movies')) {

            $id = $movie->insert([
                'title' => $this->request->getPost('title'),
                'description' => $this->request->getPost('description'),
                'category_id' => $this->request->getPost('category_id'),
            ]);

//            $this->_upload();

            // Set a flash message
            return redirect()->to("/movie/$id/edit")->with('message', 'Película creada con éxito');

        }

        return redirect()->back()->withInput();
    }

    public function show($id = null) {

        $movie = new MovieModel();

        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        var_dump($movie->asObject()->find($id)->id);
    }

    public function edit($id = null) {

        $movie = new MovieModel();
        $category = new CategoryModel();

        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }

//        echo "Sesión: " . session('message');

        $validation = \Config\Services::validation();

        $this->_loadDefaultView(
            'Editar película',
            [
                'validation' => $validation,
                'movie' => $movie->asObject()->find($id),
                'categories' => $category->asObject()->findAll()
            ],
            'edit'
        );
    }

    public function update($id = null) {

        $movie = new MovieModel();

        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        if ($this->validate('movies')) {

            $movie->update(
                $id,
                [
                    'title' => $this->request->getPost('title'),
                    'description' => $this->request->getPost('description'),
                    'category_id' => $this->request->getPost('category_id'),
                ]);

            $this->_upload($id);

            // Set a flash message
            return redirect()->to('/movie')->with('message', 'Película editada con éxito');

        }

        return redirect()->back()->withInput();
    }

    public function delete($id = null) {

        $movie = new MovieModel();

        if ($movie->find($id) == null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $movie->delete($id);

        // Set a flash message
        return redirect()->to('/movie')->with('message', 'Película eliminada con éxito');
    }

    private function _upload($movieId) {

        $image = new MovieImageModel();

        if ($imagefile = $this->request->getFile('image')) {

            if ($imagefile->isValid() && !$imagefile->hasMoved()) {
                $newName = $imagefile->getRandomName();
                $imagefile->move(WRITEPATH . 'uploads/movies/' . $movieId, $newName);

                $image->save([
                    'movie_id' => $movieId,
                    'image' => $newName,
                ]);
            }

        }

    }

    private function _loadDefaultView($title, $data, $view) {

        $dataHeader = [
            'title' => $title
        ];

        echo view("dashboard/templates/header", $dataHeader);
        echo view("dashboard/movie/$view", $data);
        echo view("dashboard/templates/footer");
    }
}