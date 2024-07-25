<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Customer;
use Database\Factories\NullableProvider;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\NotificationTask>
 */
class NotificationTaskFactory extends Factory
{

    protected $providers = [
        NullableProvider::class,
    ];
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->unique()->randomNumber(5, true),
            'processflow_history_id' => $this->faker->numberBetween(1, 100),
            'formbuilder_data_id' => $this->faker->numberBetween(1, 100),
            'entity_id' => $this->faker->numberBetween(1, 100),
            'entity_type' => $this->faker->randomElement(['customer', 'supplier']),
            'user_id' => $this->faker->numberBetween(1, 3),
            'processflow_id' => $this->faker->numberBetween(1, 100),
            'processflow_step_id' => $this->faker->numberBetween(1, 100),
            'title' => $this->generateTaskTitle(),
            'route' => $this->generateTaskRoute(),
            'start_time' => $this->faker->date(),
            'end_time' => $this->faker->date(),
            'task_status' => $this->faker->randomElement([0, 1]),

        ];

    }

    private function generateTaskRoute(): string
    {
        $routePatterns = [
            '/admin/records/customer/:customerId/:locationId/overview',
            '/admin/records/customer?createCustomer=true',
            '/admin/records/customer/:customerId/:locationId/eoirequest',
            '/admin/records/customer/:customerId/:locationId/costanalysis',
            '/admin/records/customer/:customerId',
            '/admin/records/customer/:customerId/:locationId/customermanager',
            '/admin/records/supplier/:supplierId/:locationId/overview',
            '/admin/records/supplier/:supplierId/:locationId/paymenthistory',
            '/admin/records/supplier/:supplierId/:locationId/profiledetails',
            '/admin/records/customer',
            '/admin/records/customer/:customerId/:locationId/agreement',
            '/admin/records/customer/:customerId/:locationId/customerdetails',
            '/admin/records/supplier',
        ];
        $selectedPattern = $routePatterns[array_rand($routePatterns)];
        $route = preg_replace_callback('/:(\w+)Id/', function ($matches) {
            return str_pad(rand(1, 100), 3, '0', STR_PAD_LEFT);
        }, $selectedPattern);
        return 'https://ngml.skillzserver.com' . $route;
    }

    private function generateTaskTitle(): string
    {
        $titles = [
            'Review Customer EOI',
            'Add Customer EOI',
            'Update Customer Location',
            'Add Customer Location',
            'Review Customer DDQ',
            'Add Customer DDQ',
            'Schedule Site Visitation',
            'Verify Supplier Credentials',
            'Generate Monthly Report',
            'Review Contract Terms',
            'Customer Survey',
            'Resolve Customer Complaint',
            'Audit Supplier Performance',
        ];

        return $this->faker->randomElement($titles);
    }

}
