<?php

namespace App\Providers;

use App\Models\Payment;
use App\Models\RecyclingOperations;
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
        view()->composer('partials.sidebar', function ($view)
        {
            if (auth()->user()->can('recycling confirm')) {
                $waiting_recycling = RecyclingOperations::where('verified', 'approved_wait')->count();
                $view->with('waiting_recycling', $waiting_recycling );
            }
            if (auth()->user()->can('payment confirm')) {
                $waiting_payment = Payment::where('is_success', 'waiting')->count();
                $view->with('waiting_payment', $waiting_payment );
            }

            $user_total_recycling = auth()->user()->recycling()->where('verified', 'approved')->where('is_payment_received', '0')->count();
            $view->with('total_recycling', $user_total_recycling);

        });
    }
}
