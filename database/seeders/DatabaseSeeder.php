<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        
        // Clear existing data
        DB::table('users')->truncate();
        DB::table('categories')->truncate();
        DB::table('items')->truncate();
        DB::table('customers')->truncate();
        DB::table('bills')->truncate();
        DB::table('services')->truncate();

        // Users
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@epson.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        for ($i = 2; $i <= 10; $i++) {
            $users[] = [
                'name' => 'User ' . $i,
                'email' => 'user' . $i . '@epson.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('users')->insert($users);

        // Categories
        $categories = [
            ['name' => 'Printer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Scanner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Projector', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Ink Cartridge', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toner', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Paper', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Accessories', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'POS System', 'created_at' => now(), 'updated_at' => now()],
            ['name' => '3D Printer', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Label Printer', 'created_at' => now(), 'updated_at' => now()]
        ];
        DB::table('categories')->insert($categories);

        // Items
        $items = [];
        $brands = ['Epson', 'Brother', 'Canon', 'HP', 'Xerox'];
        $units = ['pcs', 'box', 'pack', 'set', 'unit'];
        
        for ($i = 1; $i <= 10; $i++) {
            $items[] = [
                'category_id' => rand(1, 10),
                'name' => 'Product ' . $i,
                'brand' => $brands[array_rand($brands)],
                'purchase_price' => rand(500000, 5000000),
                'selling_price' => rand(600000, 5500000),
                'satuan_barang' => $units[array_rand($units)],
                'stock' => rand(5, 100),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('items')->insert($items);

        // Customers
        $customers = [];
        for ($i = 1; $i <= 10; $i++) {
            $customers[] = [
                'name' => 'Customer ' . $i,
                'address' => 'Jl. Example No.' . $i . ', Jakarta',
                'telephone' => '0812' . rand(1000000, 9999999),
                'email' => 'customer' . $i . '@example.com',
                'NIK' => '320101010101000' . $i,
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('customers')->insert($customers);

        // Bills
        $bills = [];
        for ($i = 1; $i <= 10; $i++) {
            $amount = rand(1, 5);
            $sellingPrice = DB::table('items')->where('id', $i)->value('selling_price');
            
            $bills[] = [
                'item_id' => $i,
                'customer_id' => rand(1, 10),
                'amount' => $amount,
                'total' => $amount * $sellingPrice,
                'period' => now()->subMonths(rand(0, 6))->format('Y-m-d'),
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('bills')->insert($bills);

        // Services
        $serviceStatuses = ['pending', 'in_progress', 'completed'];
        $serviceDescriptions = [
            'Printer not working',
            'Scanner not detected',
            'Need ink replacement',
            'Paper jam issue',
            'Regular maintenance',
            'Hardware repair',
            'Software installation',
            'Network configuration',
            'Print quality issue',
            'Warranty service'
        ];
        
        $services = [];
        for ($i = 1; $i <= 10; $i++) {
            $services[] = [
                'item_id' => rand(1, 10),
                'customer_id' => rand(1, 10),
                'description' => $serviceDescriptions[array_rand($serviceDescriptions)],
                'service_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                'status' => $serviceStatuses[array_rand($serviceStatuses)],
                'created_at' => now(),
                'updated_at' => now()
            ];
        }
        DB::table('services')->insert($services);

        // Enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}