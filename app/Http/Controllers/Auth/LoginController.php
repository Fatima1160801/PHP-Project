<?php

namespace App\Http\Controllers\Auth;

use App\Models\Activity\Activity;
use App\Models\Activity\ActivityBeneficiaries;
use App\Models\Activity\ActivityIndicators;
use App\Models\Activity\ActivityResult;
use App\Models\Activity\ActivityStaff;
use App\Models\Activity\Location;
use App\Models\Goals\Results;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }


    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
//    protected function credentials(Request $request)
//    {
//        $credentials = $request->only($this->username(), 'password');
//        return array_add($credentials, 'user_status_id', '1');
//    }


    /**
     * Handle a login request to the application.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //dd($request->email,$request->password);
         $this->validateLogin($request);

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);

            return $this->sendLockoutResponse($request);
        }

//        if ($this->attemptLogin($request)) {
//            return $this->sendLoginResponse($request);
//        }

        // This section is the only change
        if ($this->guard()->validate($this->credentials($request))) {
            $user = $this->guard()->getLastAttempted();

            // Make sure the user is active
            if (($user->user_status_id == 1) && $this->attemptLogin($request)) {

                ///login to api
                 //dd($request->email,$request->password);
                $login=loginToApi($request->email,$request->password);
                if($login){

                }else{
                    return response(['status'=>false,'user_status_id' => 'Please communicate the Admin.']);
                }


               return response(['status'=>true]);
                // Send the normal successful login response
              //  return $this->sendLoginResponse($request);
            } else {

                // Increment the failed login attempts and redirect back to the
                // login form with an error message.
                $this->incrementLoginAttempts($request);
              /*  return redirect()
                    ->back()
                    ->withInput($request->only($this->username(), 'remember'))
                    ->withErrors(['user_status_id' => 'You must be active to login.']);*/
                return response(['status'=>false,'user_status_id' => 'Please communicate the Admin.']);
             }
        }


        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
          $this->incrementLoginAttempts($request);

        return $this->sendFailedLoginResponse($request);
        return response(['status'=>false]);
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        $field = filter_var($request->get($this->username()), FILTER_VALIDATE_EMAIL)
            ? $this->username()
            : 'user_name';

        return [
            $field => $request->get($this->username()),
            'password' => $request->password,
        ];

        //  return $request->only($this->username(), 'password');
    }

    public function logout(Request $request)
    {

        deleteActivity();
        deleteTask();
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/');
    }




}
