<?php

namespace Database\Seeders;

use App\Models\StripePlan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic Plan',
                'amount' => 119,
                'stripe_plan_id' => 'price_1P5m7bF5DVUNPpm9jW3IzCsC',
            ],
            [
                'name' => 'Premium Plan',
                'amount' => 159,
                'stripe_plan_id' => 'price_1P5m80F5DVUNPpm9qmQWZ0Rd',
            ],
            [
                'name' => 'Standard Plan',
                'amount' => 399,
                'stripe_plan_id' => 'price_1P5m8HF5DVUNPpm9rWBAKJaJ',
            ],
        ];

        foreach ($plans as $plan) {
            StripePlan::create($plan);
        }
    }
}
