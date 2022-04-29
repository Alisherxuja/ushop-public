<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductAttachmentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'product_id' => 1, 'image' => 'products/19dMiSzC41NdCXcdWTrXW8iHyAEoNBt1G4BDJahr.jpg'],
            ['id' => 2, 'product_id' => 2, 'image' => 'products/bYKrXqVoVEp9SNMbkrdzBKaZfTpTARe6jFJw81Rl.jpg'],
            ['id' => 3, 'product_id' => 3, 'image' => 'products/Egh0Ll574vjui4Glg5zW3kjLbp4sUMV1l8y7ZAA1.jpg'],
            ['id' => 4, 'product_id' => 4, 'image' => 'products/hWSd70GD7HgDIgP3TrnR0lJ3CVpEAEYB3KNqTs0z.jpg'],
            ['id' => 5, 'product_id' => 5, 'image' => 'products/pcklRuEmCwhpVjYiPQRnsWnJ4nMGJ3HXOobJVZJk.jpg'],
            ['id' => 6, 'product_id' => 6, 'image' => 'products/4jUN7PiVHCY9MEGdxXUWWwxqQ2n9JYrtcwUDvt2U.jpg'],
            ['id' => 7, 'product_id' => 7, 'image' => 'products/Sm6hahZFbweoqgPdExUQdJ7MwJPctR2SvPtUjQbD.jpg'],
            ['id' => 8, 'product_id' => 8, 'image' => 'products/t4ep6LxumfLIxVGBilRSsm98lRLpzyxEGNKJjE2X.jpg'],
            ['id' => 9, 'product_id' => 9, 'image' => 'products/n9Venh4s8gJnXH4rHw1nUKrXrwAk8ldYRD8Lidet.jpg'],
            ['id' => 10, 'product_id' => 10, 'image' => 'products/MJRDEhp44MgGr0dsaqYUnOmJI9lkEXLtFI25JH2e.jpg'],
            ['id' => 11, 'product_id' => 11, 'image' => 'products/tUq7A3BQj6Sik9YGbEwgzm4JRiU3JctmzY4hT9FG.jpg'],
            ['id' => 12, 'product_id' => 12, 'image' => 'products/hOrLPttpntu2EOOkJid7nqEvgIxhTttJIcIyEokj.jpg'],
            ['id' => 13, 'product_id' => 13, 'image' => 'products/5hje3eVruXvdhh4QorSRIB9WKsi5a9wZYyNBLdQg.jpg'],
            ['id' => 14, 'product_id' => 14, 'image' => 'products/xla044NgNQMwYtacXjleKDR305ixFUNoxxG53Uve.jpg'],
            ['id' => 15, 'product_id' => 15, 'image' => 'products/aH8mFrDfOZXLMOhEEI6ca5DkqBinEiueIX7ocxBC.jpg'],
            ['id' => 16, 'product_id' => 16, 'image' => 'products/uoorkmW3K20JBeNmowD7Cm4IlHDE0LKAIkRpezfH.jpg'],
            ['id' => 17, 'product_id' => 17, 'image' => 'products/nGg9sIMhyzLhHDAO2pTZ7DkJvmRnqFARXj2SrR7P.jpg'],
            ['id' => 18, 'product_id' => 18, 'image' => 'products/4XqOpJMzjQYI6TZgqiz47Du8taMhwa1t3MtTeIUM.jpg'],
            ['id' => 19, 'product_id' => 19, 'image' => 'products/W6bnMiFE6l9z5cMmR2mdZbPwosBHMmb1gkp2Vhv4.jpg']
        ];
        DB::table('product_attachments')->insert($data);
    }
}
