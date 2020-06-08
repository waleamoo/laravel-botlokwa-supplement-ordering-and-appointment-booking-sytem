<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class HcpsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $hcp = new \App\Hcp([
            'hcp_name' => 'Kenny Kenny',
            'hcp_email' => 'kenny@botlokwa.co.za',
            'hcp_password' => Hash::make('12345678'),
            'hcp_pic' => 'none'
        ]);
        $hcp->save();
        
        
    }
}
