<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        \App\User::create([
            'name' => 'Gianni',
            'surname' => 'Rodari',
            'username' => 'GRodari',
            'email' => 'GR@gmail.com',
            'password' => bcrypt('michele123')
        ]);
        \App\Collection::create([
            'titolo' => 'oof',
            'url_img' => '/images/background6.jpg',
            'id_utente' => '1'
        ]);
        \App\Collection::create([
            'titolo' => 'owof',
            'url_img' => '/images/background6.jpg',
            'id_utente' => '1'
        ]);
        \App\Collection::create([
            'titolo' => 'okof',
            'url_img' => '/images/background6.jpg',
            'id_utente' => '1'
        ]);


        \App\Track::create([
            'title' => 'dneufhrj',
            'artists' => 'prova',
            'image_url' => '/images/background6.jpg',
            'album_name' => 'dheuhfjife',
            'spotify_uri' => 'hfrgutjfefkiej'
        ]);
    }
}
