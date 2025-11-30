<?php

use Src\Route;

// ------------------------
// ГЛАВНАЯ И ОБЩИЕ СТРАНИЦЫ
// ------------------------
Route::add('GET', '/hello', [Controller\SiteController::class, 'hello'])
    ->middleware('auth');

// ------------------------
// АУТЕНТИФИКАЦИЯ
// ------------------------
Route::add(['GET', 'POST'], '/signup', [Controller\AuthController::class, 'signup']);
Route::add(['GET', 'POST'], '/login', [Controller\AuthController::class, 'login']);
Route::add('GET', '/logout', [Controller\AuthController::class, 'logout']);


// ------------------------
// КНИГИ
// ------------------------
Route::add('GET', '/create-book', [Controller\BookController::class, 'create'])
    ->middleware('role:librarian,admin');

Route::add('POST', '/create-book', [Controller\BookController::class, 'store'])
    ->middleware('role:librarian,admin');

Route::add('GET', '/books', [Controller\BookController::class, 'list'])
    ->middleware('role:librarian,admin');

Route::add(['GET', 'POST'], '/borrowers-by-book', [Controller\BookController::class, 'borrowers'])
    ->middleware('role:librarian,admin');


// ------------------------
// ЧИТАТЕЛИ
// ------------------------
Route::add('GET', '/create-reader', [Controller\ReaderController::class, 'create'])
    ->middleware('role:librarian,admin');

Route::add('POST', '/create-reader', [Controller\ReaderController::class, 'store'])
    ->middleware('role:librarian,admin');

Route::add('GET', '/readers', [Controller\ReaderController::class, 'list'])
    ->middleware('role:librarian,admin');


// ------------------------
// ВЫДАЧА И ВОЗВРАТ КНИГ
// ------------------------
Route::add('GET', '/issue-book', [Controller\BookController::class, 'issueForm'])
    ->middleware('role:librarian,admin');

Route::add('POST', '/issue-book', [Controller\BookController::class, 'issue'])
    ->middleware('role:librarian,admin');

Route::add('GET', '/return-book', [Controller\BookController::class, 'returnList'])
    ->middleware('role:librarian,admin');

Route::add('POST', '/return-book', [Controller\BookController::class, 'return'])
    ->middleware('role:librarian,admin');

Route::add(['GET', 'POST'], '/borrowed-books', [Controller\BookController::class, 'borrowed'])
    ->middleware('role:librarian,admin');


// ------------------------
// СТАТИСТИКА
// ------------------------
Route::add('GET', '/most-popular-books', [Controller\BookController::class, 'popular'])
    ->middleware('role:librarian,admin');


// ------------------------
// БИБЛИОТЕКАРИ (только админ)
// ------------------------
Route::add(['GET', 'POST'], '/create-librarian', [Controller\LibrarianController::class, 'create'])
    ->middleware('role:admin');

Route::add('GET', '/librarians', [Controller\LibrarianController::class, 'list'])
    ->middleware('role:admin');
