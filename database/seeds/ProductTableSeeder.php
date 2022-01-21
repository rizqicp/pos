<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Product::create([
            'category_id' => '1',
            'supplier_id' => '1',
            'name' => 'Majoo Desktop',
            'description' => '<p><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam congue purus dui, rutrum sollicitudin risus eleifend sed. Cras auctor quam quis molestie ultrices. Proin nec orci velit. Integer convallis odio sed diam convallis luctus. Curabitur sit amet justo dictum velit commodo pharetra. Donec faucibus ligula ac ex tincidunt, sit amet interdum eros viverra. Proin dignissim velit nibh, et eleifend massa commodo id. Etiam tristique nec risus et molestie. Integer et risus id lorem posuere blandit eget non urna.</span><br></p>',
            'buy_price' => '2500000',
            'sell_price' => '2750000',
            'quantity' => '10',
            'image' => 'image.jpg'
        ]);

        App\Models\Product::create([
            'category_id' => '1',
            'supplier_id' => '2',
            'name' => 'Majoo Lifestyle',
            'description' => '<p><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam congue purus dui, rutrum sollicitudin risus eleifend sed. Cras auctor quam quis molestie ultrices. Proin nec orci velit. Integer convallis odio sed diam convallis luctus. Curabitur sit amet justo dictum velit commodo pharetra. Donec faucibus ligula ac ex tincidunt, sit amet interdum eros viverra. Proin dignissim velit nibh, et eleifend massa commodo id. Etiam tristique nec risus et molestie. Integer et risus id lorem posuere blandit eget non urna.</span><br></p>',
            'buy_price' => '2500000',
            'sell_price' => '2750000',
            'quantity' => '10',
            'image' => 'image.jpg'
        ]);

        App\Models\Product::create([
            'category_id' => '2',
            'supplier_id' => '3',
            'name' => 'Majoo Advance',
            'description' => '<p><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam congue purus dui, rutrum sollicitudin risus eleifend sed. Cras auctor quam quis molestie ultrices. Proin nec orci velit. Integer convallis odio sed diam convallis luctus. Curabitur sit amet justo dictum velit commodo pharetra. Donec faucibus ligula ac ex tincidunt, sit amet interdum eros viverra. Proin dignissim velit nibh, et eleifend massa commodo id. Etiam tristique nec risus et molestie. Integer et risus id lorem posuere blandit eget non urna.</span><br></p>',
            'buy_price' => '2500000',
            'sell_price' => '2750000',
            'quantity' => '10',
            'image' => 'image.jpg'
        ]);

        App\Models\Product::create([
            'category_id' => '3',
            'supplier_id' => '3',
            'name' => 'Majoo Pro',
            'description' => '<p><span style="color: rgb(0, 0, 0); font-family: &quot;Open Sans&quot;, Arial, sans-serif; font-size: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam congue purus dui, rutrum sollicitudin risus eleifend sed. Cras auctor quam quis molestie ultrices. Proin nec orci velit. Integer convallis odio sed diam convallis luctus. Curabitur sit amet justo dictum velit commodo pharetra. Donec faucibus ligula ac ex tincidunt, sit amet interdum eros viverra. Proin dignissim velit nibh, et eleifend massa commodo id. Etiam tristique nec risus et molestie. Integer et risus id lorem posuere blandit eget non urna.</span><br></p>',
            'buy_price' => '2500000',
            'sell_price' => '2750000',
            'quantity' => '10',
            'image' => 'image.jpg'
        ]);

    }
}
