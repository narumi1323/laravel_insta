<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    private $category;
    public function __construct(Category $category)
    {
        $this->category = $category;
    }
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name'        => 'Travel',
                'created_at'  => Now(),
                'updated_at'  => Now()
            ],
            [
                'name'        => 'Food',
                'created_at'  => Now(),
                'updated_at'  => Now()
            ],
            [
                'name'        => 'LifeStyle',
                'created_at'  => Now(),
                'updated_at'  => Now()
            ],
        ];
        $this->category->insert($categories);
    }
}
