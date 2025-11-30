<?php

namespace Controller;

use Src\View;
use Src\Request;
use Src\Auth\Auth;
use Model\User;

class AuthController
{
    public function signup(Request $request): string
    {
        if ($request->method === 'POST') {
            $data = $request->all();

            $validator = new \Src\Validator\Validator(
                $data,
                [
                    'name' => ['required'],
                    'login' => ['required', 'unique:users,login'],
                    'password' => ['required'],
                ]
            );

            if ($validator->fails()) {
                return new View('site.signup', [
                    'errors' => $validator->errors(),
                    'old' => $data
                ]);
            }

            $data['password'] = md5($data['password']);
            User::create($data);

            app()->route->redirect('/login');
        }

        return new View('site.signup');
    }

    public function login(Request $request): string
    {
        if ($request->method === 'GET') {
            return new View('site.login');
        }

        if (Auth::attempt($request->all())) {
            app()->route->redirect('/hello');
        }

        return new View('site.login', ['message' => 'Неверный логин или пароль']);
    }

    public function logout(): void
    {
        Auth::logout();
        app()->route->redirect('/hello');
    }
}
