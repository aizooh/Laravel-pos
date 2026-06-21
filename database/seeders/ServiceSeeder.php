<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        $services = [
            ['name' => 'Print B&W',           'category' => 'Printing',    'icon' => '🖨️', 'price_per_unit' => 10,  'unit' => 'page' ],
            ['name' => 'Print Color',          'category' => 'Printing',    'icon' => '🖨️', 'price_per_unit' => 30,  'unit' => 'page' ],
            ['name' => 'Scanning',             'category' => 'Scanning',    'icon' => '📄', 'price_per_unit' => 20,  'unit' => 'page' ],
            ['name' => 'Photocopy',            'category' => 'Photocopy',   'icon' => '📋', 'price_per_unit' => 5,   'unit' => 'page' ],
            ['name' => 'Typing / CV',          'category' => 'Typing',      'icon' => '⌨️', 'price_per_unit' => 50,  'unit' => 'page' ],
            ['name' => 'Lamination A4',        'category' => 'Lamination',  'icon' => '📑', 'price_per_unit' => 100, 'unit' => 'piece'],
            ['name' => 'Lamination A5',        'category' => 'Lamination',  'icon' => '📑', 'price_per_unit' => 70,  'unit' => 'piece'],
            ['name' => 'Passport Photo (Set)', 'category' => 'Photos',      'icon' => '📷', 'price_per_unit' => 200, 'unit' => 'set'  ],
            ['name' => 'Passport Photo x1',    'category' => 'Photos',      'icon' => '📷', 'price_per_unit' => 60,  'unit' => 'piece'],
        ];

        foreach ($services as $service) {
            Service::updateOrCreate(
                ['name' => $service['name']],
                array_merge($service, ['is_active' => true])
            );
        }
    }
}
