<?php namespace App\Models;

use CodeIgniter\Model;

class MovieModel extends Model {
    protected $table = 'movies';
    protected $primaryKey = 'id';

    public function get($id = null) {
        if ($id === null) {
            return $this->findAll();
        }

        return $this->asObject()
            ->where(['id' => $id])
            ->first();
    }
}