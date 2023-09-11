<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class probonocategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        \App\Models\Probonocategory::factory()->create(['name' => 'Case Against RBA']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Lagal Aid to Genaral Public']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Minors']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Supreme Court']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Count']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Prosecutor']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Police']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Prison']);
        \App\Models\Probonocategory::factory()->create(['name' => 'Others']);
    }
}
