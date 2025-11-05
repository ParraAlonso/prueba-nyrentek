<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
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
    protected $redirectTo = '/tareas';

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
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'second_last_name' => ['nullable','string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'last_name' => $data['last_name'],
            'second_last_name' => $data['second_last_name'],
            'email' => $data['email']
        ]);
    }


    //Se sobreescribe la función register() de RegistersUsers para manejar el registro del usuario
    public function register(Request $request)
    {
        //Validar la información
        $this->validator($request->all())->validate();
        //Creación del usuario
        $user = $this->create($request->all());
        //Generar el token de restablecimiento de contraseña
        $token = Password::broker()->createToken($user);
        //Enlace de restablecimiento
        $url = url(route('password.reset', ['token' => $token, 'email' => $user->email], false));
        try {
            //Envío de enlace para establecimiento de nueva contraseña
            $user->notify(new \App\Notifications\CustomResetPassword($url));
            return redirect()->route('login')->with('success', "Usuario creado correctamente, para completar tu registro revisa la bandeja de entrada de tu correo electrónico.");
        }catch (\Exception $exception){
            Log::error($exception->getMessage());
            return redirect()->back()->with('error', "Ocurrió un problema, por favor intente nuevamente.")->withInput();
        }

    }
}
