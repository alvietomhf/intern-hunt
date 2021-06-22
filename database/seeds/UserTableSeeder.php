<?php

use App\Biography;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'siswa']);
        Role::create(['name' => 'guru']);
        Role::create(['name' => 'industri']);

        $siswa = User::create([
            'name' => 'Siswa1',
            'username' => 'siswa1',
            'address' => 'Surabaya',
            'phone' => '082234897333',
            'schname' => 'SMKN 1 Surabaya',
            'department' => 'RPL',
            'image' => 'profile1.png',
            'password' => Hash::make('password'),
        ]);

        $siswa->assignRole('siswa');

        $guru = User::create([
            'name' => 'Guru1',
            'username' => 'guru1',
            'address' => 'Surabaya',
            'phone' => '082234897332',
            'schname' => 'SMKN 1 Surabaya',
            'image' => 'profile2.png',
            'password' => Hash::make('password'),
        ]);

        $guru->assignRole('guru');

        $industri = User::create([
            'name' => 'Industri1',
            'username' => 'industri1',
            'image' => 'profile3.png',
            'password' => Hash::make('password'),
        ]);

        $industri->assignRole('industri');
        Biography::create([
            'user_id' => $industri->id
        ]);

    }
}
