<?php

use App\EBP\Entities\ContactUsInfo;
use App\EBP\Entities\Introduction;
use Illuminate\Database\Seeder;

class IntroductionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id'      => 1,
                'content' => 'This is app about the newly formed VDC / Municipality of Nepal.',
            ],
            [
                'id'      => 2,
                'content' => 'This is the app which gives the detail of this municipality',
            ],
        ];
        app(Introduction::class)->truncate();
        foreach ($data as $datum) {

            app(Introduction::class)->create($datum);
        }
    }
}
