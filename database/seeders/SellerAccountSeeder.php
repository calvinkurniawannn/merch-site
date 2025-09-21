<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\SellerAccount;

class SellerAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        SellerAccount::create([
            'account_code'=> 'calvinstore',
            'store_name'    => 'Calvin Official Store',
            'logo'          => 'logos/calvin.png',
            'theme_color'   => '#1E90FF',
            'contact_email' => 'calvin_store@example.com',
            'contact_phone' => '08123456789',
                'modified_by' => 'system',
                'modified_date' => now(),
                'created_by' => 'system',
                'created_date' => now(),
        ]);
                SellerAccount::create([
            'account_code'=> 'seica',
            'store_name'    => 'Seica',
            'logo'          => 'logos/calvin.png',
            'theme_color'   => '#1E90FF',
            'contact_email' => 'seica@example.com',
            'contact_phone' => '08123456789',
                'modified_by' => 'system',
                'modified_date' => now(),
                'created_by' => 'system',
                'created_date' => now(),
        ]);
    }
}