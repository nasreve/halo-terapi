<?php

namespace App\Http\Controllers\Auth\Therapist;

use App\Models\Province;
use App\Models\Therapist;
use Illuminate\Http\Request;
use App\Rules\PhoneUniqueRule;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

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
    protected $redirectTo = RouteServiceProvider::THERAPISTHOME;

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
     * Show step 1 registration
     *
     * @return void
     */
    public function step1()
    {
        return view('visitor.therapist.auth.register.step-1');
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
            'email' => ['required', 'string', 'email', 'max:255', 'unique:therapists'],
            'username' => ['required', 'unique:therapists'],
            'whatsapp' => ['bail', 'required', 'digits_between:7,14', new PhoneUniqueRule('therapists', 'whatsapp')],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ], [], [
            'name' => 'nama dan gelar',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\Therapist
     */
    protected function create(array $data)
    {
        $therapist = Therapist::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => str_replace(' ', '', $data['username']),
            'whatsapp' => $data['whatsapp']
        ]);

        $therapist->password = Hash::make($data['password']);
        $therapist->save();

        return $therapist;
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

        event(new Registered($therapist = $this->create($request->all())));

        if ($response = $this->registered($request, $therapist)) {
            return $response;
        }

        return $request->wantsJson()
            ? new JsonResponse([], 201)
            : redirect()->route('therapist.verification.show', $therapist->id);
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('therapist');
    }
}
