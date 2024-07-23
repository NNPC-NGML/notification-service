<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\NotificationTask;



class NotificationTaskSeeder extends Seeder
// {
//     public function run(): void
//     {
//     NotificationTask::factory()
//         ->count(50)
//         ->create([
//             'user_id'=>1,
//             'route' => $this->generateTaskRoute(),
//         ]);
//     }

//     /**
//      * Generate a random task route.
//      *
//      * @return string
//      */
//     private function generateTaskRoute(): string
//     {
//         $routePatterns = [
//             '/admin/records/customer/:customerId/:locationId/overview',
//             '/admin/records/customer?createCustomer=true',
//             '/admin/records/customer/:customerId/:locationId/eoirequest',
//             '/admin/records/customer/:customerId/:locationId/costanalysis',
//             '/admin/records/customer/:customerId',
//             '/admin/records/customer/:customerId/:locationId/customermanager',
//             '/admin/records/supplier/:supplierId/:locationId/overview',
//             '/admin/records/supplier/:supplierId/:locationId/paymenthistory',
//             '/admin/records/customer',
//         ];
//         $selectedPattern = $routePatterns[array_rand($routePatterns)];
//         $route = preg_replace_callback('/:(\w+)Id/', function ($matches) {
//             return str_pad(rand(1, 100), 3, '0', STR_PAD_LEFT);
//         }, $selectedPattern);
//         return 'https://ngml.skillzserver.com' . $route;
//     }
}
