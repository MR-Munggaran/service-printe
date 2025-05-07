<?php
// database/seeders/TransactionSeeder.php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Transaction;
use App\Models\Customer;
use App\Models\User;

class TransactionSeeder extends Seeder
{
    public function run()
    {
        $customer = Customer::first();
        $user = User::whereHas('roles', fn($q) => $q->where('name','user'))->first();

        Transaction::create([
            'invoice_no'    => 'INV-'.now()->format('Ymd').'-001',
            'customer_id'   => $customer->id,
            'user_id'       => $user->id,
            'total'         => 1000000,
            'paid'          => 1000000,
            'change'        => 0,
            'discount'      => 0,
            'grand_total'   => 1000000,
            'payment_method'=> 'cash',
            'status'        => 'paid',
        ]);
    }
}
