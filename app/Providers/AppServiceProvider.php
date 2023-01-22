<?php

namespace App\Providers;

use App\Services\AmountInWords;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

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

        Paginator::useBootstrap();
        Str::macro('date', function ($val) {
            return Carbon::parse($val)->toDateString('Y-M-D');
        });
        Str::macro('currency', function ($price) {
            if ($price < 0) {
                $price = abs($price);
                return "(" . number_format($price, 2, '.', ',') . ")";
            }
            return   number_format($price, 2, '.', ',');
        });
        Str::macro('dayDate', function ($date) {
            $date = Carbon::parse($date);
            return $date->toDayDateTimeString();
        });

        Str::macro('percentage', function ($numerator, $denominator) {
            if ($numerator == 0 || $denominator == 0) {
                return 0;
            }
            $res = ($numerator / $denominator) * 100;
            return number_format($res, 2, '.', ',');
        });

        Str::macro('inwords', function ($amount) {
            $aiw = new AmountInWords();
            return $aiw->amountInWords($amount);
        });
    }
}