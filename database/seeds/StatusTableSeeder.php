<?php

use App\EBP\Entities\Status\Status;
use Illuminate\Database\Seeder;

/**
 * Class StatusTableSeeder
 */
class StatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        foreach (config('status') as $status) {
//            app(Status::class)->firstOrCreate(['slug' => $status['slug'], 'name'=>$status['name'], 'status_for'=>$status['status_for']], $status);
//        }
    }
}
