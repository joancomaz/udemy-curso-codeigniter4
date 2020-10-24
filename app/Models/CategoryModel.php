<?php namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model {
    protected $table = 'categories';
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