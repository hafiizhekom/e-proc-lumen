<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('users')->insert([
            'username' => Str::random(15),
            'nama_lengkap' => Str::random(10),
            'email' => Str::random(10).'@gmail.com',
            'password' => md5('password'),
            'jenis_kelamin' => array('Wanita', 'Pria')[rand(0,1)],
            'tanggal_lahir' => Carbon::parse('2000-01-01'),
            'no_handphone' => Str::random(10),
            'alamat' => Str::random(30)
        ]);
    }
}
