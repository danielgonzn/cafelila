<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            ['question' => 'Que tipo de cafe ofrece CafeLila?', 'answer' => 'Ofrecemos cafe gourmet con distintos niveles de tueste y presentaciones.', 'order' => 1],
            ['question' => 'Realizan ventas para empresas?', 'answer' => 'Si, trabajamos con socios comerciales y clientes corporativos.', 'order' => 2],
            ['question' => 'Como puedo solicitar informacion comercial?', 'answer' => 'Puedes escribirnos desde el formulario de contacto o via WhatsApp.', 'order' => 3],
        ];

        foreach ($faqs as $faq) {
            Faq::query()->updateOrCreate(
                ['question' => $faq['question']],
                ['answer' => $faq['answer'], 'order' => $faq['order'], 'status' => true]
            );
        }
    }
}
