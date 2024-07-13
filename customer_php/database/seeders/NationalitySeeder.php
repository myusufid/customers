<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NationalitySeeder extends Seeder
{
    public function run()
    {
        $nationalities = [
            ['nationality_name' => 'Indian', 'nationality_code' => 'IN'],
            ['nationality_name' => 'American', 'nationality_code' => 'US'],
            ['nationality_name' => 'British', 'nationality_code' => 'GB'],
            ['nationality_name' => 'Canadian', 'nationality_code' => 'CA'],
            ['nationality_name' => 'German', 'nationality_code' => 'DE'],
            ['nationality_name' => 'French', 'nationality_code' => 'FR'],
            ['nationality_name' => 'Italian', 'nationality_code' => 'IT'],
            ['nationality_name' => 'Spanish', 'nationality_code' => 'ES'],
            ['nationality_name' => 'Chinese', 'nationality_code' => 'CN'],
            ['nationality_name' => 'Japanese', 'nationality_code' => 'JP'],
            ['nationality_name' => 'Australian', 'nationality_code' => 'AU'],
            ['nationality_name' => 'Mexican', 'nationality_code' => 'MX'],
            ['nationality_name' => 'Russian', 'nationality_code' => 'RU'],
            ['nationality_name' => 'South African', 'nationality_code' => 'ZA'],
            ['nationality_name' => 'Brazilian', 'nationality_code' => 'BR'],
            ['nationality_name' => 'Saudi Arabian', 'nationality_code' => 'SA'],
            ['nationality_name' => 'New Zealander', 'nationality_code' => 'NZ'],
            ['nationality_name' => 'Dutch', 'nationality_code' => 'NL'],
            ['nationality_name' => 'Irish', 'nationality_code' => 'IE'],
            ['nationality_name' => 'Swedish', 'nationality_code' => 'SE']
        ];

        foreach ($nationalities as $nationality) {
            DB::table('nationality')->insert([
                'nationality_name' => $nationality['nationality_name'],
                'nationality_code' => $nationality['nationality_code'],
                'created_at' => \Carbon\Carbon::now(),
                'updated_at' => \Carbon\Carbon::now(),
            ]);
        }
    }
}
