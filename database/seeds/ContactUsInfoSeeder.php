<?php

use App\EBP\Entities\ContactUsInfo;
use Illuminate\Database\Seeder;

class ContactUsInfoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'title'       => 'Palika',
        ];
        app(ContactUsInfo::class)->truncate();
        app(ContactUsInfo::class)->create($data);
    }
}
