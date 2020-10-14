<?php

use Illuminate\Database\Seeder;
use App\Client;
class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = ['jabar','raad'];
        foreach($clients as $client){
            Client::create([
                'name'=> $client,
                'phone'=>'07812345678',
                'address'=> 'baghdad'
            ]);
        }
    }
}
