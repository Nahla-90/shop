<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    /**
     * Created by Nahla Sameh
     * first route check user login
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function index()
    {
        if (Auth::check()) {
            /* If user loggedIn then redirect to products*/
            return redirect('products');
        } else {
            /* If no loggedIn user then redirect to login*/
            return redirect('login');
        }
    }

    /**
     * Created by Nahla Sameh
     * Login view
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function login()
    {
        return view('login');
    }

    /**
     * Created by Nahla Sameh
     * login user using request data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Illuminate\Validation\ValidationException
     */
    function loginPost(Request $request)
    {
        /* Define Validation Rules*/
        $validationRules = array(
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:8',
        );

        /* Do the validation */
        $validator = Validator::make($request->all(), $validationRules);

        /* Check Validation*/
        if ($validator->fails()) {

            $errors = array();
            foreach ($validator->errors()->getMessages() as $key => $message) {
                $errors[$key] = implode(', ', $message);
            }

           return response()->json(array('errors' => $errors));

        } else {

            /* define $email and $password from request data*/
            $email = $request->get('email');
            $password = $request->get('password');

            /* Login using defined data*/
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                /* If logged in successfully then redirect to home*/
               return response()->json(array('success' => 'User logged in successfuly'));

            } else {
                /* if login fails then back with error*/
               return response()->json(array('errors' => array('message'=>'Wrong Login Details')));
            }

        }
    }

    /**
     * Created by Nahla Sameh
     * Logout
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Created by Nahla Sameh
     * Register View
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    function register()
    {
        return view('register');
    }

    /**
     * Created by Nahla Sameh
     * Create new user using requested user data
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    function registerPost(Request $request)
    {
        /* Define Validation Rules*/
        $validationRules = array(
            'name' => 'required|string',
            'email' => 'required|email',
            'password' => 'required|alphaNum|min:8',
            'confirmPassword' => 'required|same:password'
        );

        /* Do the validation */
        $validator = Validator::make($request->all(), $validationRules);

        /* Check Validation*/
        if ($validator->fails()) {

            $errors = array();
            foreach ($validator->errors()->getMessages() as $key => $message) {
                $errors[$key] = implode(', ', $message);
            }

           return response()->json(array('errors' => $errors));

        } else {
            /* If User data Valid */

            /* define $name, $email and $password from request data*/
            $name = $request->get('name');
            $email = $request->get('email');
            $password = $request->get('password');

            /* Create new user */
            $user = User::create(array('name' => $name, 'email' => $email, 'password' => Hash::make($password),));

            /* Login using defined data*/
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                /* If logged in successfully then redirect to home*/
               return response()->json(array('success' => 'User logged in successfuly'));

            } else {
                /* if login fails then back with error*/
               return response()->json(array('errors' => array('message'=>'Wrong Login Details')));
            }
        }
    }
}
