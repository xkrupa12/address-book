<?php

/** @var Router $router */

use App\Http\Controllers\ContactsController;
use Illuminate\Routing\Router;

$router->get('/', [ContactsController::class, 'index'])->name('contacts.index');
$router->get('create', [ContactsController::class, 'create'])->name('contacts.create');
$router->post('create', [ContactsController::class, 'store'])->name('contacts.store');
$router->get('{id}', [ContactsController::class, 'edit'])->name('contacts.edit');
$router->put('{id}', [ContactsController::class, 'update'])->name('contacts.update');
$router->delete('{id}', [ContactsController::class, 'delete'])->name('contacts.delete');
