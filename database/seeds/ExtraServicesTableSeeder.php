<?php

use App\Extra_service;
use Illuminate\Database\Seeder;

class ExtraServicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $extraServices = ['cucina', 'wi-fi', 'aria condizionata', 'riscaldamento', 'posto auto', 'piscina', 'tv', 'bagno privato', 'culla', 'asciugacapelli', 'cassetta di sicurezza', 'lavatrice', 'self check-in', 'vista panoramica'];
    
        foreach ($extraServices as $extraService) {
            $newExtraService = new Extra_service();
            $newExtraService->name = $extraService;

            $newExtraService->save();
        }
    
    }


}
