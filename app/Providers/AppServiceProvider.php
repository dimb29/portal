<?php

namespace App\Providers;

use Jenssegers\Agent\Agent;
use App\Models\Ads;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $ads_top = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'top')->first();
        $ads_bottom = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'bottom')->take(3)->get();
        $ads_middle = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'middle')->take(3)->get();
        $ads_right_top = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'right_top')->first();
        $ads_right_bottom = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'right_bottom')->take(3)->get();
        $ads_right_middle = Ads::orderBy('created_at', 'DESC')->select(['images', 'url'])->where('type', 'right_middle')->take(3)->get();
        $agent = new Agent();
        View::share([
            'agent' => $agent,
            'ads_top' => $ads_top,
            'ads_bottom' => $ads_bottom,
            'ads_middle' => $ads_middle,
            'ads_right_top' => $ads_right_top,
            'ads_right_bottom' => $ads_right_bottom,
            'ads_right_middle' => $ads_right_middle,
        ]);
    }
}
