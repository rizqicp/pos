<?php

use Illuminate\Database\Seeder;

class TransactionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Transaction::create([
            'user_id' => '1',
            'product_id' => '1',
            'quantity' => '3'
        ]);
        App\Models\Transaction::create([
            'user_id' => '1',
            'product_id' => '2',
            'quantity' => '5'
        ]);
        App\Models\Transaction::create([
            'user_id' => '1',
            'product_id' => '3',
            'quantity' => '10'
        ]);
        App\Models\Transaction::create([
            'user_id' => '2',
            'product_id' => '4',
            'quantity' => '2'
        ]);
        App\Models\Transaction::create([
            'user_id' => '2',
            'product_id' => '3',
            'quantity' => '1'
        ]);

    }
}
