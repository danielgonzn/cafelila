<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $settings = SiteSetting::query()->pluck('value', 'key');

        return view('frontend.home', [
            'products' => Product::query()->active()->orderBy('name')->get(),
            'faqs' => Faq::query()->active()->orderBy('order')->get(),
            'gallery' => Gallery::query()->latest()->take(9)->get(),
            'settings' => $settings,
        ]);
    }
}
