<?php

/** @var Router $router */

use App\Http\Controllers\ContactAddressesController;
use App\Http\Controllers\ContactEmailsController;
use App\Http\Controllers\ContactPhonesController;
use App\Http\Controllers\ContactsController;
use Illuminate\Routing\Router;

$router->permanentRedirect('/',  'contacts');

$router->group(['prefix' => 'contacts'], function (Router $router) {
    $router->get('/', [ContactsController::class, 'index'])->name('contacts.index');
    $router->get('create', [ContactsController::class, 'create'])->name('contacts.create');
    $router->post('create', [ContactsController::class, 'store'])->name('contacts.store');
    $router->get('{id}', [ContactsController::class, 'edit'])->name('contacts.edit');
    $router->put('{id}', [ContactsController::class, 'update'])->name('contacts.update');
    $router->delete('{id}', [ContactsController::class, 'delete'])->name('contacts.delete');

    $router->post('{contactId}/emails', [ContactEmailsController::class, 'store'])->name('contacts.emails.store');
    $router->patch('{contactId}/emails/{emailId}', [ContactEmailsController::class, 'update'])->name('contacts.emails.update');
    $router->delete('{contactId}/emails', [ContactEmailsController::class, 'store'])->name('contacts.emails.store');

    $router->post('{contactId}/phones', [ContactPhonesController::class, 'store'])->name('contacts.phones.store');
    $router->patch('{contactId}/phones/{phoneId}', [ContactPhonesController::class, 'update'])->name('contacts.phones.update');
    $router->delete('{contactId}/phones', [ContactPhonesController::class, 'delete'])->name('contacts.phones.delete');

    $router->post('{contactId}/addresses/{addressId}/set-primary', [ContactAddressesController::class, 'setPrimary'])
        ->name('contacts.phones.store');
});
