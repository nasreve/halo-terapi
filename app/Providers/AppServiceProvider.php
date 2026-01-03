<?php

namespace App\Providers;

use App\Models\Order;
use App\Models\Therapist;
use Carbon\Carbon;
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
        Carbon::setLocale('id');

        $this->shareUnpaidOrderCount();
        $this->shareStatusTherapistCount();
        $this->shareVisitorOrder();
        $this->shareUserData();
        $this->therapistOrderCount();
    }

    /**
     * Share order jumlah order yang tampil di halaman terapis
     */
    public function therapistOrderCount()
    {
        View::composer('visitor.layouts.therapist-aside', function ($view) {
            $view->with('shareOrder', auth('therapist')->user()->orders()->where(function ($query) {
                $query->where(function ($query) {
                    $query->where('payment_status', 'Sudah Dibayar')->where('buyer_payment_method', 'Transfer');
                })
                ->orWhere(function ($query) {
                    $query->where('buyer_payment_method', 'Cash');
                });
            }));
        });
    }

    /**
     * Share data jumlah order yang belum di bayar ke
     * semua view yang menggunakan layouts admin.layouts.app
     *
     * @return void
     */
    public function shareUnpaidOrderCount()
    {
        View::composer('admin.layouts.app', function ($view) {
            $order = new Order();
            $view->with('unpaidOrderCount', $order->getUnpaidOrderCount());
        });
    }

    /**
     * Share data jumlah order yang belum di bayar ke
     * semua view yang menggunakan layouts admin.layouts.app
     *
     * @return void
     */
    public function shareStatusTherapistCount()
    {
        View::composer('admin.layouts.app', function ($view) {
            $therapist = new Therapist();
            $view->with('statusTherapistCount', $therapist->getStatusTherapistCount());
        });
    }

    /**
     * Share data order mencegah error
     *
     * @return void
     */
    public function shareVisitorOrder()
    {
        View::composer(['visitor.layouts.app', 'visitor.includes.cart'], function ($view) {
            if (!session()->has('orderVisitor')) {
                session(['orderVisitor' => collect()]);
            }

            $view->with([
                'orders' => session('orderVisitor'),
            ]);
        });
    }

    /**
     * Share data user dan patient ke aside menu
     *
     * @return void
     */
    public function shareUserData()
    {
        View::composer(['visitor.layouts.therapist-aside', 'visitor.layouts.patient-aside', 'visitor.layouts.app'], function ($view) {
            $view->with([
                'patient' => $this->patientUserData(),
                'therapist' => $this->therapistUserData()
            ]);
        });
    }

    /**
     * Mengambil data pasien
     *
     * @return void
     */
    private function patientUserData()
    {
        if (auth()->guard('patient')->check()) {
            return auth()->guard('patient')->user();
        }
    }

    /**
     * Mengambil data terapis
     *
     * @return void
     */
    private function therapistUserData()
    {
        if (auth()->guard('therapist')->check()) {
            return auth()->guard('therapist')->user();
        }
    }
}
