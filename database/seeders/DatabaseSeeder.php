<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Dotenv\Util\Str;
use App\Models\Branch;
use App\Models\Branche;
use App\Models\Section;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        DB::table('users')->insert([
            'name' => 'Omar Khaled',
            'email' => 'omar@resala.app',
            'phone' => '01068778340',
            'password' => Hash::make('omar@resala.app'),
        ]);

        // seed all branches
        $branches = [
            [
                'name' => 'المعادي',
                'email' => 'volmaadi@resala.app',
                'password' => Hash::make('volmaadi@resala.app'),
            ],
            [
                'name' => 'المهنديسن',
                'email' => 'volmohandseen@resala.app',
                'password' => Hash::make('volmohandseen@resala.app'),
            ],
            [
                'name' => 'فيصل',
                'email' => 'volfasel@resala.app',
                'password' => Hash::make('volfasel@resala.app'),
            ],
            [
                'name' => 'حلوان',
                'email' => 'volhelwan@resala.app',
                'password' => Hash::make('volhelwan@resala.app'),
            ],
            [
                'name' => 'مصر الجديدة',
                'email' => 'volmgedida@resala.app',
                'password' => Hash::make('volmgedida@resala.app'),
            ],
            [
                'name' => 'أكتوبر',
                'email' => 'voloctobar@resala.app',
                'password' => Hash::make('voloctobar@resala.app'),
            ],
            [
                'name' => 'الاسكندرية',
                'email' => 'volalexandria@resala.app',
                'password' => Hash::make('volalexandria@resala.app'),
            ],
            [
                'name' => 'المقطم',
                'email' => 'volmoqatm@resala.app',
                'password' => Hash::make('volmaadi@resala.app'),
            ],
            [
                'name' => 'مدينة نصر',
                'email' => 'volmnasr@resala.app',
                'password' => Hash::make('volmnasr@resala.app'),
            ],
            
        ];

        foreach ($branches as $branche) {
            Branche::create($branche);
        };

        ////////////////////////////////////

        // seed all sections
        $sections = [
            [
                'name' => 'معارض داخلي',
                'email' => 'maared@resala.app',
                'password' => Hash::make('maared@resala.app'),
            ],
            [
                'name' => 'الفرز',
                'email' => 'farz@resala.app',
                'password' => Hash::make('farz@resala.app'),
            ],
            [
                'name' => 'RTC',
                'email' => 'rtc@resala.app',
                'password' => Hash::make('rtc@resala.app'),
            ],
         
            
        ];
        foreach ($sections as $section) {
            Section::create($section);
        };
 

    
    }
}
