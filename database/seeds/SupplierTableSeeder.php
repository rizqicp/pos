<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Models\Supplier::create([
            'name' => 'Win Computer',
            'phone' => '085731000839',
            'address' => 'ITC Mega Grosir Lantai 2 Blok K3A no 3, Jl. Gembong No 20 - 30, Surabaya, Jawa Timur, Indonesia'
        ]);

        App\Models\Supplier::create([
            'name' => 'PT. Bhinneka Mentari Dimensi',
            'phone' => '082112529122',
            'address' => 'Mangga Dua Mall Lt. 3 No. 48 49, RT.1/RW.12, Mangga Dua Sel., Kecamatan Sawah Besar, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta'
        ]);

        App\Models\Supplier::create([
            'name' => 'Ali Cell Distributor',
            'phone' => '081235111161',
            'address' => 'Jl. Taruna No.18, Sritanjung, Wage, Kec. Taman, Kabupaten Sidoarjo, Jawa Timur'
        ]);

    }
}
