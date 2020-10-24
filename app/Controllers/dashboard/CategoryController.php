<?php namespace App\Controllers\dashboard;
use App\Controllers\BaseController;
use App\Models\CategoryModel;

class CategoryController extends BaseController {

    public function index() {
        return view("dashboard/templates/header");
    }

    public function show() {

        $category = new CategoryModel();

        var_dump($category->get());



    }

}