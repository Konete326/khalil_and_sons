<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $bridal = Category::where('slug', 'bridal-suites')->first();
        $choker = Category::where('slug', 'chokers-necklaces')->first();
        $kada = Category::where('slug', 'bangles-kadas')->first();
        $ring = Category::where('slug', 'polki-rings')->first();
        $jhumka = Category::where('slug', 'heritage-jhumkas')->first();

        $products = [
            [
                'category_id' => $bridal?->id,
                'title' => 'Royal Mughal Choker Set 22K with Burmese Rubies',
                'slug' => 'royal-mughal-choker-set-22k-burmese-rubies',
                'karat' => '22K',
                'gross_weight_grams' => 85.500,
                'net_gold_weight_grams' => 72.200,
                'making_charges' => 95000.00,
                'gemstone_cost' => 185000.00,
                'stone_description' => 'Certified unheated pigeon-blood Burmese rubies and natural Basra seed pearls.',
                'images' => ['/assets/products/choker-ruby-01.jpg', '/assets/products/choker-ruby-02.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $kada?->id,
                'title' => 'Zeenat Uncut Polki Bridal Kada 22K',
                'slug' => 'zeenat-uncut-polki-bridal-kada-22k',
                'karat' => '22K',
                'gross_weight_grams' => 54.250,
                'net_gold_weight_grams' => 46.800,
                'making_charges' => 68000.00,
                'gemstone_cost' => 142000.00,
                'stone_description' => 'Syndicate uncut polki diamonds set in 24K gold foil with green meenakari back.',
                'images' => ['/assets/products/kada-polki-01.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $kada?->id,
                'title' => 'Dastkari 22K Solid Gold Heritage Bangle Pair',
                'slug' => 'dastkari-22k-solid-gold-heritage-bangle-pair',
                'karat' => '22K',
                'gross_weight_grams' => 48.500,
                'net_gold_weight_grams' => 48.500,
                'making_charges' => 48500.00,
                'gemstone_cost' => 0.00,
                'stone_description' => 'Plain 22K hallmark gold without stones. Hand-chiseled Karachi filigree finish.',
                'images' => ['/assets/products/kada-plain-01.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $jhumka?->id,
                'title' => 'Noor-ul-Ain 22K Filigree Chandbali Jhumkas',
                'slug' => 'noor-ul-ain-22k-filigree-chandbali-jhumkas',
                'karat' => '22K',
                'gross_weight_grams' => 32.400,
                'net_gold_weight_grams' => 30.100,
                'making_charges' => 42000.00,
                'gemstone_cost' => 35000.00,
                'stone_description' => 'Hand-chiseled Karachi filigree drops with natural South Sea baroque pearls.',
                'images' => ['/assets/products/jhumka-01.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $choker?->id,
                'title' => 'Shahi Kundan Guluband 21K',
                'slug' => 'shahi-kundan-guluband-21k',
                'karat' => '21K',
                'gross_weight_grams' => 64.800,
                'net_gold_weight_grams' => 58.500,
                'making_charges' => 75000.00,
                'gemstone_cost' => 92000.00,
                'stone_description' => 'Traditional Mughal Jadau setting with brilliant cut polki and emerald drops.',
                'images' => ['/assets/products/guluband-01.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'category_id' => $ring?->id,
                'title' => 'Koh-i-Noor Royal Polki Cocktail Ring 22K',
                'slug' => 'koh-i-noor-royal-polki-cocktail-ring-22k',
                'karat' => '22K',
                'gross_weight_grams' => 18.200,
                'net_gold_weight_grams' => 14.900,
                'making_charges' => 28000.00,
                'gemstone_cost' => 65000.00,
                'stone_description' => 'Solitaire uncut diamond polki surrounded by Burmese ruby cabochons.',
                'images' => ['/assets/products/ring-polki-01.jpg'],
                'model_3d_url' => null,
                'is_featured' => true,
                'is_active' => true,
            ],
        ];

        foreach ($products as $product) {
            if ($product['category_id']) {
                Product::updateOrCreate(['slug' => $product['slug']], $product);
            }
        }
    }
}
