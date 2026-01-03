<?php

namespace App\Http\Controllers;
use App\Notifications\PatientOrderNotification;
use App\Notifications\TherapistOrderNotification;
use App\Notifications\AdminOrderNotification;
use App\Notifications\TherapistRegisterNotification;
use App\Mail\Mailer;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class EmailNotificationController extends Controller
{
    public function index(Request $request)
    {
        $data = [
            'name' => 'Doe',
        ];

        try {
            Mail::to('patient@gmail.com')->send(new PatientOrderNotification($data));
            Mail::to('therapist@gmail.com')->send(new TherapistOrderNotification($data));
            Mail::to('admin@gmail.com')->send(new AdminOrderNotification($data));
            Mail::to('therapist@gmail.com')->send(new TherapistRegisterNotification($data));
            echo '
                Email order untuk pasien barhasil terkirim <br> 
                Email order untuk terapis barhasil terkirim <br> 
                Email order untuk admin barhasil terkirim <br> 
                Email register terapis diterima maupun tidak diterima berhasil terkirim
            ';
        } catch (\Exception $e) {
            echo 'Error - '.$e;
        }
    }
}
