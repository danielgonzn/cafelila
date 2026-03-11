<?php

namespace Database\Seeders;

use App\Models\HomeBanner;
use Illuminate\Database\Seeder;

class HomeBannerSeeder extends Seeder
{
    public function run(): void
    {
        $banners = [
            [
                'title' => 'CafeLila Gourmet para tu negocio',
                'subtitle' => 'Cafe premium de Costa Rica para socios comerciales que buscan consistencia y calidad superior.',
                'cta_text' => 'Ver catalogo',
                'cta_url' => '#productos',
                'order' => 1,
                'is_active' => true,
            ],
            [
                'title' => 'Tueste artesanal y perfil balanceado',
                'subtitle' => 'Seleccion cuidadosa del grano, procesos estandarizados y un sabor que fideliza clientes.',
                'cta_text' => 'Conoce mas',
                'cta_url' => '#nosotros',
                'order' => 2,
                'is_active' => true,
            ],
            [
                'title' => 'Listos para abastecerte',
                'subtitle' => 'Atencion cercana para cafeterias, tiendas y distribuidores en crecimiento.',
                'cta_text' => 'Contactar',
                'cta_url' => '#contacto',
                'order' => 3,
                'is_active' => true,
            ],
        ];

        foreach ($banners as $banner) {
            HomeBanner::query()->updateOrCreate(
                ['title' => $banner['title']],
                [
                    'subtitle' => $banner['subtitle'],
                    'image' => null,
                    'cta_text' => $banner['cta_text'],
                    'cta_url' => $banner['cta_url'],
                    'order' => $banner['order'],
                    'is_active' => $banner['is_active'],
                ]
            );
        }
    }
}
