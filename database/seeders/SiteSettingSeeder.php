<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'hero_title' => 'Tecnologia Industrial para el Procesamiento de Cafe',
            'hero_subtitle' => 'Importacion de cafe de alta gama y materia prima para potenciar tu produccion.',
            'about_text' => 'Cafe Lila nace de la necesidad de brindar un producto de alta calidad al mercado costarricense con un cafe gourmet que pueda llegar al mercado nacional por medio de socios comerciales.',
            'mission' => 'Llevar cafe gourmet de calidad superior a cada socio comercial.',
            'vision' => 'Ser referencia premium del cafe costarricense en Centroamerica.',
            'values' => 'Calidad, consistencia, cercania, innovacion y compromiso.',
            'address' => 'Costa Rica, Puntarenas, Coto Brus, Sabalito, Barrio Mercedes, Contiguo a Mayoreo BM',
            'phone' => '+506 8967 1132',
            'email' => 'lila.roastery@gmail.com',
            'email_secondary' => 'oficinalila@gmail.com',
            'instagram' => 'https://www.instagram.com/cafelila.cr',
            'meta_title' => 'CafeLila | Cafe Gourmet de Costa Rica',
            'meta_description' => 'CafeLila produce cafe gourmet premium en Costa Rica para aliados comerciales y amantes del cafe de especialidad.',
            'logo_image' => '',
            'hero_background_image' => '',
            'og_image' => '',
            'maps_embed_url' => 'https://www.google.com/maps?q=Coto+Brus+Sabalito+Barrio+Mercedes&output=embed',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::query()->updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
