<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Bridal Suites',
                'slug' => 'bridal-suites',
                'description' => 'Generational wedding sets crafted in royal 22K gold with precious stones and heirloom polki.',
                'image_path' => '/assets/categories/bridal-suites.jpg',
                'sort_order' => 1,
            ],
            [
                'name' => 'Chokers & Necklaces',
                'slug' => 'chokers-necklaces',
                'description' => 'Intricate Mughal gulubands, regal collars, and hand-carved filigree neckwear.',
                'image_path' => '/assets/categories/chokers.jpg',
                'sort_order' => 2,
            ],
            [
                'name' => 'Bangles & Kadas',
                'slug' => 'bangles-kadas',
                'description' => 'Solid 22K hallmark-certified traditional kadas, bridal bangles, and pacchi work pairs.',
                'image_path' => '/assets/categories/kadas.jpg',
                'sort_order' => 3,
            ],
            [
                'name' => 'Polki Rings',
                'slug' => 'polki-rings',
                'description' => 'Bespoke uncut diamond solitaires and heritage cocktail rings with enamel meenakari.',
                'image_path' => '/assets/categories/rings.jpg',
                'sort_order' => 4,
            ],
            [
                'name' => 'Heritage Jhumkas',
                'slug' => 'heritage-jhumkas',
                'description' => 'Classic Karachi Sarafa chandeliers, multi-tier gold jhumkis, and pearl drop earrings.',
                'image_path' => '/assets/categories/jhumkas.jpg',
                'sort_order' => 5,
            ],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['slug' => $category['slug']], $category);
        }
    }
}
