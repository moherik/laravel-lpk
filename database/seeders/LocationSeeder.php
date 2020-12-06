<?php

namespace Database\Seeders;

use App\Models\Location;
use App\Models\LocationType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $locationTypes = [
            [
                'title' => 'Apotek',
                'slug' => Str::slug('Apotek'),
                'description' => 'deskripsi disini',
                'user_id' => 1,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Rumah Sakit',
                'slug' => Str::slug('Rumah Sakit'),
                'description' => 'deskripsi disini',
                'user_id' => 1,
                'created_at' => Carbon::now(),
            ]
        ];

        LocationType::insert($locationTypes);

        $locations = [
            [
                'title' => 'RSUD Dr. Soegiri Lamongan',
                'address' => 'Jl. Kusuma Bangsa No.7, Beringin, Tumenggungan, Kec. Lamongan, Kabupaten Lamongan, Jawa Timur 62214',
                'phone' => '(0322) 321718',
                'lat_long' => '-7.468098470354285, 112.22876843944812',
                'website' => 'soegiri.rs',
                'is_verif' => 1,
                'status' => 'PUBLISH',
                'user_id' => 1,
                'location_type_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Rumah Sakit Muhammadiyah Lamongan',
                'address' => 'Jl. Jaksa Agung Suprapto No.76, Sarirejo, Sukorejo, Kec. Lamongan, Kabupaten Lamongan, Jawa Timur 62215',
                'phone' => '+62322322834',
                'lat_long' => '-7.468098470354285, 112.22876843944812',
                'website' => 'www.rsmlamongan.com',
                'is_verif' => 1,
                'status' => 'PUBLISH',
                'user_id' => 1,
                'location_type_id' => 2,
                'created_at' => Carbon::now(),
            ],
            [
                'title' => 'Apotek Sartika',
                'address' => 'Jl. Lamongrejo No.100, Krajan, Tumenggungan, Kec. Lamongan, Kabupaten Lamongan, Jawa Timur 62214',
                'phone' => '+62322321255',
                'lat_long' => '-7.468098470354285, 112.22876843944812',
                'website' => null,
                'is_verif' => 1,
                'status' => 'PUBLISH',
                'user_id' => 1,
                'location_type_id' => 1,
                'created_at' => Carbon::now(),
            ]
        ];

        Location::insert($locations);

    }
}
