<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SubscriptionPlan;

class SubscriptionPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'builder.step_3.plans.demo',
                'price' => 0,
                'currency' => 'EUR',
                'features' => [
                    'builder.step_3.plans.for_testing_only',
                    'builder.step_3.plans.one_week_trial',
                    'builder.step_3.plans.all_features',
                ],
                'order' => 1,
                'active' => true
            ],
            [
                'name' =>  'builder.step_3.plans.basic',
                'price' => 49,
                'currency' => 'EUR',
                'features' => [
                    'builder.step_3.plans.website',
                    'builder.step_3.plans.one_user',
                    'builder.step_3.plans.one_gb_storage', 
                ],
                'order' => 2,
                'active' => false
            ],
            [
                'name' => 'builder.step_3.plans.professional',
                'price' => 89,
                'currency' => 'EUR',
                'features' => [
                    'builder.step_3.plans.website',
                    'builder.step_3.plans.mobile_app',
                    'builder.step_3.plans.unlimited_users_storage',
                ],
                'order' => 3,
                'active' => false
            ]
        ];

        foreach ($plans as $plan) {
            SubscriptionPlan::create($plan);
        }
    }
}
