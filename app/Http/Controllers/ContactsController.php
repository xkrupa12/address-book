<?php

namespace App\Http\Controllers;

use App\Repositories\ContactsRepository;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ContactsController extends Controller
{
    /**
     * @var ContactsRepository
     */
    private $repository;

    /**
     * @param ContactsRepository $repository
     */
    public function __construct(ContactsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        return view('contacts.index', [
            'contacts' => $this->repository->get(),
        ]);
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return view('contacts.create');
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        // store new contact
        $contact = $this->repository->create($request->all());

        return redirect()->route('contacts.index')->with('success', $contact->fullName . ' has been saved');
    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('contacts.edit', [
            'contact' => $this->repository->findOrFail($id),
        ]);
    }

    /**
     * @param int $id
     * @param Request $request
     * @return RedirectResponse
     */
    public function update(int $id, Request $request)
    {
        $this->repository->update($id, $request->all());

        return redirect()->route('contacts.edit', ['id' => $id])->with('success', 'Changes have been saved');
    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $this->repository->delete($id);

        return redirect()->route('contacts.index')->with('success', 'Contact has been deleted');
    }
}
