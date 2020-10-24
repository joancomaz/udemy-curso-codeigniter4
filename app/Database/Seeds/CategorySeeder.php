<?php namespace App\Database\Seeds;

class CategorySeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $this->db->table('categories')->where('id >', 0)->delete();
        $this->db->table('categories')->truncate();

        // Simple Queries
        /*$this->db->query("INSERT INTO categories (title, description) VALUES(:title:, :description:)",
            $data
        );*/

        // Using Query Builder
        for ($i=1; $i<=10; $i++) {

            $data = [
                'name' => "Category $i",
            ];

            $this->db->table('categories')->insert($data);
        }


    }
}