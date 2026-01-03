<?php

namespace App\Http\Controllers\Auth\Referrer;

use App\Http\Controllers\Controller;
use App\Http\Services\ReferrerService;
use App\Models\Patient;
use App\Models\Province;
use App\Models\Referrer;
use App\Providers\RouteServiceProvider;
use App\Rules\PhoneUniqueRule;
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
        return view('visitor.referrer.register', [
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:patients'],
            'province_id' => ['required'],
            'regency_id' => ['required'],
            'district_id' => ['required'],
            'village' => ['required'],
            'address' => ['required'],
            'address_origin' => ['required'],
            'business_community' => ['required'],
            'business_name' => ['required'],
            'business_address' => ['required'],
            'phone_number' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('patients', 'phone_number')],
            'whatsapp_number' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('patients', 'whatsapp_number')],
            'bank_name' => ['required'],
            'bank_account' => ['required'],
            'account_number' => ['required'],
            'source' => ['required'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [
            'province_id.required' => 'Kolom provinsi wajib untuk dipilih.',
            'regency_id.required' => 'Kolom kabupaten wajib untuk dipilih.',
            'district_id.required' => 'Kolom kecamatan wajib untuk dipilih.'
        ], [
            'name' => 'nama lengkap',
            'village' => 'kelurahan',
            'address' => 'detail alamat',
            'address_origin' => 'alamat asal',
            'business_community' => 'komunitas bisnis',
            'business_name' => 'nama usaha',
            'business_address' => 'alamat usaha',
            'phone_number' => 'nomor telepon',
            'whatsapp_number' => 'nomor whatsapp',
            'bank_name' => 'nama bank',
            'bank_account' => 'atas nama',
            'account_number' => 'nomor rekening',
            'source' => 'sumber informasi'
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
            'email' => $data['email'],
            'province_id' => $data['province_id'],
            'regency_id' => $data['regency_id'],
            'district_id' => $data['district_id'],
            'village' => $data['village'],
            'address' => $data['address'],
            'address_origin' => $data['address_origin'],
            'business_community' => $data['business_community'],
            'business_name' => $data['business_name'],
            'business_address' => $data['business_address'],
            'phone_number' => $data['phone_number'],
            'whatsapp_number' => $data['whatsapp_number'],
            'bank_name' => $data['bank_name'],
            'bank_account' => $data['bank_account'],
            'account_number' => $data['account_number'],
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

        $this->createReferrer($request, $user);

        return $request->ajax()
            ? new JsonResponse([
                'redirect' => route('patient.verification.show', $user->id)
            ], 201)
            : redirect()->route('patient.verification.show', $user->id);
    }

    /**
     * Create Referrer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function createReferrer(Request $request, Patient $patient)
    {
        Referrer::create($request->only([
            'business_community', 'business_name', 'business_address', 'bank_name', 'bank_account', 'account_number'
        ]) + ['patient_id' => $patient->id, 'unique_reff' => ReferrerService::generateUniqueReff()]);
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
