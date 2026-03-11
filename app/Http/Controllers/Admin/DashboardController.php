<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\HomeBanner;
use App\Models\Product;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        return view('admin.dashboard', [
            'productCount' => Product::query()->count(),
            'activeProductCount' => Product::query()->active()->count(),
            'bannerCount' => HomeBanner::query()->count(),
            'faqCount' => Faq::query()->count(),
            'galleryCount' => Gallery::query()->count(),
            'contactCount' => ContactMessage::query()->count(),
            'unreadContactCount' => ContactMessage::query()->whereNull('read_at')->count(),
        ]);
    }
}
