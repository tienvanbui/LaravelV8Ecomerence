<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::create([
            'payment_method'=>'Cash Payment',
        ]);
        Payment::create([
            'payment_method' => 'Card Payment',
        ]);
    }
}
