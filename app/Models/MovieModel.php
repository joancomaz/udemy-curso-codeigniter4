<?php namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model {
    protected $table = 'movies';
    protected $primaryKey = 'id';

    protected $allowedFields = ['title', 'description', 'category_id'];

    /*public function get($id = null) {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->asObject()
            ->where(['id' => $id])
            ->first();
    }*/

    public function getAll() {
        return $this->asObject()
            ->select('movies.*, categories.name as category_name')
            ->join('categories', 'categories.id = movies.category_id');
    }
}