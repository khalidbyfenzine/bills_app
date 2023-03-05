<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Supplier;
use App\Models\Service;
class BillFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $bill_date = $this->faker->date();
        $supplier_name = Supplier::all()->random()->Supplier_name;
        $service_name = Service::all()->random()->Service_name;

        return [
            'Bill_number' => $this->faker->numberBetween(1, 1000),
            'Supplier_name' => $supplier_name,
            'Bill_date' =>  $bill_date,
            'Deposit_date' => $this->faker->date(),
            'Due_date' =>  date('Y-m-d', strtotime($bill_date. ' + 90 days')),
            'Service_name' => $service_name,
            'Amount' => $this->faker->numberBetween(200, 1000),

        ];
    }
}
