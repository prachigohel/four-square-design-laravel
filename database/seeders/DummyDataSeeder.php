<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use App\Models\DesignRequest;
use Illuminate\Support\Facades\Hash;

class DummyDataSeeder extends Seeder
{
    public function run(): void
    {
        $adminRole = Role::where('name', 'Admin')->first();
        $managerRole = Role::where('name', 'Manager')->first();
        $designerRole = Role::where('name', 'Designer')->first();
        $clientRole = Role::where('name', 'Client')->first();

        // Create Admin
        User::updateOrCreate(['email' => 'admin@foursquare.com'], [
            'name' => 'Admin User',
            'password' => Hash::make('password'),
            'role_id' => $adminRole->id,
        ]);

        // Create Manager
        $manager = User::updateOrCreate(['email' => 'manager@foursquare.com'], [
            'name' => 'Sarah Manager',
            'password' => Hash::make('password'),
            'role_id' => $managerRole->id,
        ]);

        // Create Designers
        $designer1 = User::updateOrCreate(['email' => 'designer1@foursquare.com'], [
            'name' => 'Alex Designer',
            'password' => Hash::make('password'),
            'role_id' => $designerRole->id,
        ]);

        $designer2 = User::updateOrCreate(['email' => 'designer2@foursquare.com'], [
            'name' => 'Jordan Designer',
            'password' => Hash::make('password'),
            'role_id' => $designerRole->id,
        ]);

        // Create Clients
        $client1 = User::updateOrCreate(['email' => 'client1@gmail.com'], [
            'name' => 'John Client',
            'password' => Hash::make('password'),
            'role_id' => $clientRole->id,
            'manager_id' => $manager->id,
            'company_name' => 'Elite Homes',
        ]);

        $client2 = User::updateOrCreate(['email' => 'client2@gmail.com'], [
            'name' => 'Emily Client',
            'password' => Hash::make('password'),
            'role_id' => $clientRole->id,
            'manager_id' => $manager->id,
            'company_name' => 'Modern Living',
        ]);

        // Create Dummy Design Requests
        $requests = [
            [
                'title' => 'Luxury Kitchen Renovation - Westside',
                'status' => 'Open',
                'client_id' => $client1->id,
                'project_type' => 'Kitchen',
                'cabinet_brand' => 'KraftMaid',
                'ceiling_height' => '9ft',
            ],
            [
                'title' => 'Modern Master Bath - Heights',
                'status' => 'Assigned',
                'client_id' => $client1->id,
                'designer_id' => $designer1->id,
                'project_type' => 'Bathroom',
                'cabinet_brand' => 'Medallion',
                'ceiling_height' => '10ft',
            ],
            [
                'title' => 'Multi-Family Unit Type A',
                'status' => 'WIP',
                'client_id' => $client2->id,
                'designer_id' => $designer2->id,
                'project_type' => 'Multi-Family',
                'cabinet_brand' => 'CNC Cabinetry',
                'ceiling_height' => '8.5ft',
            ],
            [
                'title' => 'Basement Bar & Entertainment',
                'status' => 'Needs Information',
                'client_id' => $client2->id,
                'designer_id' => $designer1->id,
                'project_type' => 'Other',
                'cabinet_brand' => 'Bellmont',
                'ceiling_height' => '8ft',
            ],
            [
                'title' => 'Coastal Cottage Kitchen',
                'status' => 'Needs Approval',
                'client_id' => $client1->id,
                'designer_id' => $designer2->id,
                'project_type' => 'Kitchen',
                'cabinet_brand' => 'Fabuwood',
                'ceiling_height' => '9ft',
            ],
            [
                'title' => 'Penthouse Kitchen & Island',
                'status' => 'Closed',
                'client_id' => $client2->id,
                'designer_id' => $designer1->id,
                'project_type' => 'Kitchen',
                'cabinet_brand' => 'Plain & Fancy',
                'ceiling_height' => '12ft',
            ],
        ];

        foreach ($requests as $req) {
            DesignRequest::create($req);
        }
    }
}
