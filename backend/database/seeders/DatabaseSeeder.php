<?php

namespace Database\Seeders;

use App\Modules\Application\Seeders\ApplicationProcessSeeder;
use App\Modules\Application\Seeders\ApplicationSeeder;
use App\Modules\Application\Seeders\ProcessSeeder;
use App\Modules\Application\Seeders\TransactionSeeder;
use App\Modules\Auth\Seeders\AuthSeeder;
use App\Modules\Client\Seeders\ClientSeeder;
use App\Modules\Country\Seeders\CountrySeeder;
use App\Modules\Employee\Seeders\DesignationSeeder;
use App\Modules\Employee\Seeders\EmployeeSeeder;
use App\Modules\JobList\Seeders\JobListSeeder;
use App\Modules\Setting\Seeders\SettingSeeder;
use App\Modules\WorkOrder\Seeders\OrderDetailsCategorySeeder;
use App\Modules\WorkOrder\Seeders\OrderDetailsHeadSeeder;
use App\Modules\WorkOrder\Seeders\WorkOrderDetailSeeder;
use App\Modules\WorkOrder\Seeders\WorkOrderSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([

            AuthSeeder::class,
            DesignationSeeder::class,
            EmployeeSeeder::class,
            CountrySeeder::class,
            ClientSeeder::class,
            WorkOrderSeeder::class,
            OrderDetailsCategorySeeder::class,
            OrderDetailsHeadSeeder::class,
            WorkOrderDetailSeeder::class,
            JobListSeeder::class,
            ApplicationSeeder::class,
            ProcessSeeder::class,
            ApplicationProcessSeeder::class,
            TransactionSeeder::class,
            SettingSeeder::class,

        ]);
    }
}
