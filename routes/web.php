<?php

use App\Http\Controllers\Auth\Admin\LoginController;
use App\Http\Controllers\Auth\Admin\ForgotPasswordController;
use App\Http\Controllers\Auth\Admin\ResetPasswordController;
use App\Http\Controllers\Auth\Patient\ForgotPasswordController as PatientForgotPasswordController;
use App\Http\Controllers\Auth\Patient\LoginController as PatientLoginController;
use App\Http\Controllers\Auth\Patient\RegisterController;
use App\Http\Controllers\Auth\Patient\ResetPasswordController as PatientResetPasswordController;
use App\Http\Controllers\Auth\Patient\VerificationController as PatientVerificationController;
use App\Http\Controllers\Auth\Referrer\RegisterController as ReferrerRegisterController;
use App\Http\Controllers\Auth\Therapist\ForgotPasswordController as TherapistForgotPasswordController;
use App\Http\Controllers\Auth\Therapist\LoginController as TherapistLoginController;
use App\Http\Controllers\Auth\Therapist\RegisterController as TherapistRegisterController;
use App\Http\Controllers\Auth\Therapist\RegisterStepController;
use App\Http\Controllers\Auth\Therapist\ResetPasswordController as TherapistResetPasswordController;
use App\Http\Controllers\Auth\Therapist\VerificationController as TherapistVerificationController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\EmailNotificationController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Patient\OrderController as PatientOrderController;
use App\Http\Controllers\Patient\ReferralController;
use App\Http\Controllers\ReferrerController;
use App\Http\Controllers\RegencyController;
use App\Http\Controllers\TherapistController;
use App\Http\Controllers\Patient\SettingController as PatientSettingController;
use App\Http\Controllers\Therapist\CreateOrderController;
use App\Http\Controllers\Therapist\OrderController as TherapistOrderController;
use App\Http\Controllers\Therapist\ReferralController as TherapistReferralController;
use App\Http\Controllers\Therapist\ReportController as TherapistReportController;
use App\Http\Controllers\Therapist\SettingController as TherapistSettingController;
use App\Http\Controllers\Visitor\FormWizardController;
use App\Http\Controllers\Visitor\TherapistController as VisitorTherapistController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest', 'guest:therapist', 'preventBack', 'active.patient'])->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::post('/order', [HomeController::class, 'order']);
});

Route::get('regency/{id}', [RegencyController::class, 'filterByProvince'])->where('id', '[0-9]+')->name('regency');
Route::get('regency/{name}', [RegencyController::class, 'filterByProvinceName'])->name('regency.filterByProvinceName');
Route::post('regency', [RegencyController::class, 'all'])->name('regency.filterByName');
Route::get('district/{id}', [DistrictController::class, 'filterByRegency'])->where('id', '[0-9]+')->name('district');
Route::get('district/{name}', [DistrictController::class, 'filterByRegencyName'])->name('district.filterByRegencyName');

/**
 * Admin routes...
 */
Route::prefix('admin')->group(function () {
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware(['guest', 'guest:therapist', 'guest:patient'])->group(function () {
        Route::get('/', [LoginController::class, 'showLoginForm'])->name('login.form');
        Route::post('/', [LoginController::class, 'login'])->name('login');
        Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
        Route::post('/send-email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
        Route::get('/reset-form/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
        Route::post('/reset-password', [ResetPasswordController::class, 'reset'])->name('password.update');
    });

    Route::middleware(['auth', 'active.user', 'preventBack'])->group(function () {
        Route::get('order/list', [OrderController::class, 'listOrder'])->name('order.list');
        Route::resource('order', OrderController::class)->except(['show']);

        Route::get('patient/list', [PatientController::class, 'listPatient'])->name('patient.list');
        Route::resource('patient', PatientController::class);

        //therapist
        Route::prefix('therapist')->group(function () {
            Route::get('/list', [TherapistController::class, 'list'])->name('therapist.list');
            Route::post('/service/{therapist}', [TherapistController::class, 'updateService'])->name('therapist.updateService');
        });
        Route::resource('therapist', TherapistController::class);

        //referrer
        Route::get('referrer/list', [ReferrerController::class, 'listReferrer'])->name('referrer.list');
        Route::resource('referrer', ReferrerController::class);

        Route::prefix('setting')->group(function () {
            Route::get('/my-profile', [SettingController::class, 'showMyProfileForm'])->name('my-profile.form');
            Route::post('/my-profile', [SettingController::class, 'updateMyProfile'])->name('my-profile.update');
            Route::get('/system', [SettingController::class, 'showSystemForm'])->name('system.form');
            Route::post('/update-fee', [SettingController::class, 'updateFee'])->name('fee.update');
            Route::post('/update-nominal-fee', [SettingController::class, 'updateNominalFee'])->name('setting.updateNominalFee');
            Route::post('/update-account', [SettingController::class, 'updateAccount'])->name('account.update');
            Route::post('/update-transport', [SettingController::class, 'updateTransport'])->name('transport.update');
        });

        Route::get('/report', [ReportController::class, 'index'])->name('report.index');
        Route::get('/report/list', [ReportController::class, 'list'])->name('report.list');
    });
});

/**
 * Patient routes...
 */
Route::prefix('patient')->group(function () {
    Route::post('logout', [PatientLoginController::class, 'logout'])->name('patient.logout');
    Route::middleware(['guest', 'guest:therapist', 'guest:patient'])->group(function () {
        Route::get('/register', [RegisterController::class, 'showRegistrationForm']);
        Route::post('/register', [RegisterController::class, 'register'])->name('patient.register');

        Route::post('/', [PatientLoginController::class, 'login'])->name('patient.login');

        Route::get('/email/verify/{id}', [PatientVerificationController::class, 'show'])->name('patient.verification.show');
        Route::post('/email/verify/send', [PatientVerificationController::class, 'send'])->middleware('verifyThrottle')->name('patient.verification.send');
        Route::get('/email/verify/{id}/{hash}', [PatientVerificationController::class, 'verify'])->name('patient.verification.verify');

        Route::get('/forgot-password', [PatientForgotPasswordController::class, 'showLinkRequestForm'])->name('patient.password.request');
        Route::post('/send-email', [PatientForgotPasswordController::class, 'sendResetLinkEmail'])->name('patient.password.email');
        Route::get('/reset-form/{token}', [PatientResetPasswordController::class, 'showResetForm'])->name('patient.password.reset');
        Route::post('/reset-password', [PatientResetPasswordController::class, 'reset'])->name('patient.password.update');
    });

    Route::middleware(['auth:patient', 'active.patient', 'preventBack'])->group(function () {
        Route::prefix('order')->group(function () {
            Route::get('/step-2', [FormWizardController::class, 'step2'])->name('order.step-2');
            Route::post('/step-2/choose', [FormWizardController::class, 'chooseTherapist'])->name('order.chooseTherapist');
            Route::post('/step-2/therapist-regency', [FormWizardController::class, 'therapistRegency']);
            Route::post('/step-2/submits', [FormWizardController::class, 'step2submits'])->name('order.step2submits');
            Route::get('/step-3', [FormWizardController::class, 'step3'])->name('order.step-3');
            Route::post('/step-3/data', [FormWizardController::class, 'step3data'])->name('order.step3data');
            Route::post('/step-3/submits', [FormWizardController::class, 'step3submits'])->name('order.step3submits');
            Route::get('/step-4', [FormWizardController::class, 'step4'])->name('order.step-4');
            Route::post('/step-4/delete-service', [FormWizardController::class, 'deleteService'])->name('order.step4deleteService');
            Route::post('/step-4/submits', [FormWizardController::class, 'step4submits'])->name('order.step4submits');
            Route::post('/step-4/send-email', [FormWizardController::class, 'sendEmail'])->name('order.step4sendEmail');
            Route::get('/success', [FormWizardController::class, 'success'])->name('order.success');
            Route::get('/sendemail', [EmailNotificationController::class, 'index'])->name('sendemail');

            Route::get('/history', [PatientOrderController::class, 'index'])->name('patient.order.history');
            Route::get('/history/list', [PatientOrderController::class, 'list'])->name('patient.order.history.list');
            Route::get('/detail/{order}', [PatientOrderController::class, 'view'])->name('patient.order.detail');
            Route::get('/invoice-print/{order}', [PatientOrderController::class, 'invoicePrint'])->name('order.invoice.print');
            Route::get('/invoice-download/{order}', [PatientOrderController::class, 'invoiceDownload'])->name('order.invoice.download');
            Route::get('/repeat/{order}', [PatientOrderController::class, 'repeat'])->name('order.repeat');
            Route::post('/repeat/{order}', [PatientOrderController::class, 'replicate'])->name('order.replicate');
        });

        Route::get('/setting/general', [PatientSettingController::class, 'index'])->name('patient.setting');
        Route::post('/setting/general', [PatientSettingController::class, 'update'])->name('patient.setting.update');

        Route::prefix('referral')->group(function () {
            Route::get('/confirmation', [ReferralController::class, 'confirmation'])->name('patient.referral.confirmation');
            Route::get('/form', [ReferralController::class, 'form'])->name('patient.referral.form');
            Route::post('/activate', [ReferralController::class, 'activate'])->name('patient.referral.activate');
            Route::get('/dashboard', [ReferralController::class, 'dashboard'])->name('patient.referral.dashboard');
            Route::get('/list', [ReferralController::class, 'list'])->name('patient.referral.list');
            Route::post('/update-account', [ReferralController::class, 'updateAccount'])->name('patient.referral.updateAccount');
        });
    });
});

Route::prefix('referrer')->group(function () {
    Route::middleware('guest', 'guest:patient', 'guest:therapist')->group(function () {
        Route::get('/', [ReferrerRegisterController::class, 'showRegistrationForm'])->name('referrer.showRegistrationForm');
        Route::post('/', [ReferrerRegisterController::class, 'register'])->name('referrer.register');
    });
    Route::get('/{code}', [ReferralController::class, 'code'])->name('referrer.code');
});

/**
 * Therapist routes...
 */
Route::prefix('therapist')->group(function () {
    Route::middleware(['guest', 'guest:therapist', 'guest:patient'])->group(function () {
        Route::get('/', [TherapistLoginController::class, 'showLoginForm'])->name('therapist.showLoginForm');
        Route::post('/', [TherapistLoginController::class, 'login'])->name('therapist.login');
        Route::get('/register/step-1', [TherapistRegisterController::class, 'step1'])->name('therapist.register.step-1');
        Route::post('/register/step-1', [TherapistRegisterController::class, 'register'])->name('therapist.register.step-1.store');
        Route::get('/email/verify/{id}', [TherapistVerificationController::class, 'show'])->name('therapist.verification.show');
        Route::post('/email/verify/{id}', [TherapistVerificationController::class, 'send'])->middleware('verifyThrottle')->name('therapist.verification.send');
        Route::get('/email/verify/{id}/{hash}', [TherapistVerificationController::class, 'verify'])->name('therapist.verification.verify');

        Route::get('/forgot-password', [TherapistForgotPasswordController::class, 'showLinkRequestForm'])->name('therapist.password.request');
        Route::post('/send-email', [TherapistForgotPasswordController::class, 'sendResetLinkEmail'])->name('therapist.password.email');
        Route::get('/reset-form/{token}', [TherapistResetPasswordController::class, 'showResetForm'])->name('therapist.password.reset');
        Route::post('/reset-password', [TherapistResetPasswordController::class, 'reset'])->name('therapist.password.update');
    });

    Route::middleware(['auth:therapist', 'active.therapist', 'preventBack'])->group(function () {
        Route::post('/logout', [TherapistLoginController::class, 'logout'])->name('therapist.logout');

        Route::get('/register/step-2', [RegisterStepController::class, 'step2'])->name('therapist.register.step-2');
        Route::post('/register/step-2', [RegisterStepController::class, 'step2submit'])->name('therapist.register.step2submit');
        Route::get('/register/step-3', [RegisterStepController::class, 'step3'])->name('therapist.register.step-3');
        Route::post('/register/step-3', [RegisterStepController::class, 'step3submit'])->name('therapist.register.step3submit');
        Route::get('/register/step-4', [RegisterStepController::class, 'step4'])->name('therapist.register.step-4');
        Route::post('/register/step-4', [RegisterStepController::class, 'step4submit'])->name('therapist.register.step4submit');

        Route::middleware('therapist.register')->group(function () {
            Route::prefix('order')->group(function () {
                Route::get('/history', [TherapistOrderController::class, 'index'])->name('therapist.order.history');
                Route::get('/list', [TherapistOrderController::class, 'list'])->name('therapist.order.history.list');

                Route::middleware('approved.therapist')->group(function () {
                    Route::get('/detail/{order}', [TherapistOrderController::class, 'view'])->name('therapist.order.detail');
                    Route::patch('/update/{order}', [TherapistOrderController::class, 'update'])->name('therapist.order.update');

                    Route::get('/invoice-print/{order}', [TherapistOrderController::class, 'invoicePrint'])->name('therapist.order.invoice.print');
                    Route::get('/invoice-download/{order}', [TherapistOrderController::class, 'invoiceDownload'])->name('therapist.order.invoice.download');

                    Route::get('/step-1', [CreateOrderController::class, 'step1'])->name('therapist.order.step-1');
                    Route::post('/select-service', [CreateOrderController::class, 'selectService'])->name('therapist.order.selectService');
                    Route::get('/step-2', [CreateOrderController::class, 'step2'])->name('therapist.order.step-2');
                    Route::post('/step-2/data', [CreateOrderController::class, 'step2data'])->name('therapist.order.step2data');
                    Route::post('/step-2/email', [CreateOrderController::class, 'step2email'])->name('therapist.order.step2email');
                    Route::post('/step-2/email/apply', [CreateOrderController::class, 'step2emailApply'])->name('therapist.order.step2emailApply');
                    Route::post('/step-2/submit', [CreateOrderController::class, 'step2submit'])->name('therapist.order.step2submit');
                    Route::get('/step-3', [CreateOrderController::class, 'step3'])->name('therapist.order.step-3');
                    Route::post('/step-3/delete', [CreateOrderController::class, 'step3delete'])->name('therapist.order.step3delete');
                    Route::post('/step-3/submit', [CreateOrderController::class, 'step3submit'])->name('therapist.order.step3submit');

                    Route::get('/repeat/{order}', [TherapistOrderController::class, 'repeat'])->name('therapist.order.repeat');
                    Route::post('/repeat/{order}', [TherapistOrderController::class, 'replicate'])->name('therapist.order.replicate');
                });
            });

            Route::get('/setting/general', [TherapistSettingController::class, 'show'])->name('therapist.setting');
            Route::post('/setting/general/personal-data', [TherapistSettingController::class, 'updatePersonalData'])->name('therapist.setting.updatePersonalData');
            Route::post('/setting/general/experience', [TherapistSettingController::class, 'updateExperience'])->name('therapist.setting.updateExperience');
            Route::post('/setting/general/service', [TherapistSettingController::class, 'updateService'])->name('therapist.setting.updateService');
            Route::post('/setting/general/service', [TherapistSettingController::class, 'updateService'])->name('therapist.setting.updateService');
            Route::post('/setting/general/homecare', [TherapistSettingController::class, 'updateHomecare'])->name('therapist.setting.updateHomecare');
            Route::post('/setting/general/account', [TherapistSettingController::class, 'updateAccount'])->name('therapist.setting.updateAccount');
            Route::post('/setting/general/photo', [TherapistSettingController::class, 'updatePhoto'])->name('therapist.setting.updatePhoto');

            Route::prefix('referral')->group(function () {
                Route::get('/confirmation', [TherapistReferralController::class, 'confirmation'])->name('therapist.referral.confirmation');
                Route::middleware('approved.therapist')->group(function () {
                    Route::get('/form', [TherapistReferralController::class, 'form'])->name('therapist.referral.form');
                    Route::post('/activate', [TherapistReferralController::class, 'activate'])->name('therapist.referral.activate');
                    Route::get('/dashboard', [TherapistReferralController::class, 'dashboard'])->name('therapist.referral.dashboard');
                    Route::get('/list', [TherapistReferralController::class, 'list'])->name('therapist.referral.list');
                    Route::post('/update-account', [TherapistReferralController::class, 'updateAccount'])->name('therapist.referral.updateAccount');
                });
            });

            Route::get('/report', [TherapistReportController::class, 'index'])->name('therapist.report');
            Route::get('/report/list', [TherapistReportController::class, 'list'])->name('therapist.report.list');
        });
    });

    Route::middleware(['guest', 'guest:therapist'])->group(function () {
        Route::get('/{username}', [VisitorTherapistController::class, 'view'])->name('therapist.profile');
        Route::post('/{username}/order', [VisitorTherapistController::class, 'order'])
            ->name('therapist.order');
    });

    Route::middleware(['auth:patient'])->group(function () {
        Route::get('/{username}/order/step-2', [VisitorTherapistController::class, 'step2'])->name('order.profile.step-2');
        Route::post('/{username}/order/step-2/data', [VisitorTherapistController::class, 'step2data'])->name('order.profile.step2data');
        Route::post('/{username}/order/step-2/submits', [VisitorTherapistController::class, 'step2submits'])->name('order.profile.step2submits');
        Route::get('/{username}/order/step-3', [VisitorTherapistController::class, 'step3'])->name('order.profile.step-3');
        Route::post('/{username}/order/step3submits', [VisitorTherapistController::class, 'step3submits'])->name('order.profile.step3submits');
        Route::get('/{username}/order/success', [VisitorTherapistController::class, 'success'])->name('order.profile.success');
    });
});

Route::get('/components', function () {
    return view('visitor.component');
})->name('component');

Route::fallback(function () {
    return abort('404');
});
