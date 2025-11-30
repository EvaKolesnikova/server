<?php

namespace Controller;

use Model\User;
use Src\View;
use Src\Request;
use Src\Auth\Auth;

class LibrarianController
{
    public function create(Request $request): string
    {
        if (!Auth::user()->isAdmin()) {
            app()->route->redirect('/login');
        }

        if ($request->method === 'POST') {
            User::create([
                'name' => $request->name,
                'login' => $request->login,
                'password' => $request->password,
                'role' => 'librarian'
            ]);

            return new View('site/create_librarian', [
                'message' => 'Библиотекарь добавлен!'
            ]);
        }

        return new View('site/create_librarian');
    }

    public function list(): string
    {
        return new View('site/list_librarian', [
            'librarians' => User::where('role', 'librarian')->get()
        ]);
    }
}
