<?php

use App\Device;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Device::unguard();

        $devices = [
            [
                'serial' => '000000000b74156f',
                'api_token' => 'cDXiZ5a3NDKgUkOYMoFpNMLs21Oi4IHCCE23CJGifBLN4CzwZb4wtWYTkacWMv5g',
                'room' => 'UB30501'
            ],
        ];

        foreach ($devices as $device) {
            Device::create($device);
        }

        Device::reguard();
    }
}
