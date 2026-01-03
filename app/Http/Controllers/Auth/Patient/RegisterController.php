<?php

namespace App\Http\Controllers\Auth\Patient;

use App\Http\Controllers\Controller;
use App\Models\Patient;
use App\Models\Province;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::PATIENTHOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('visitor.patient.auth.register', [
            'provinces' => Province::all()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'whatsapp_number' => ['required', 'numeric', 'digits_between:7,14'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'province_id' => ['required'],
            'regency_id' => ['required'],
            'district_id' => ['required'],
            'source' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.'
        ], [
            'name' => 'nama lengkap',
            'source' => 'sumber informasi',
            'whatsapp_number' => 'nomor whatsapp'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Patient
     */
    protected function create(array $data)
    {
        $patient = Patient::create([
            'name' => $data['name'],
            'whatsapp_number' => $data['whatsapp_number'],
            'email' => $data['email'],
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'district_id' => $data['district_id'],
            'district_id' => $data['district_id'],
            'source' => $data['source'],
        ]);

        $patient->password = Hash::make($data['password']);
        $patient->save();

        return $patient;
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        if ($response = $this->registered($request, $user)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('patient.verification.show', $user->id);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('patient');
    }
}
