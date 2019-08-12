<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreContact;
use App\Repositories\ContactsRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
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
            'contacts' => $this->repository->get([], ['address', 'phoneNumber', 'email'])->sortBy('surname')->values(),
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
     * @param StoreContact $request
     * @return JsonResponse
     */
    public function store(StoreContact $request): JsonResponse
    {
        try {
            $contact = $this->repository->create($request->only(['name', 'surname', 'note']));
            return response()->json($contact, 201);
        } catch (Exception $e) {
            return response()->json([], 400);
        }

    }

    /**
     * @param int $id
     * @return View
     */
    public function edit(int $id): View
    {
        return view('contacts.edit', [
            'contact' => $this->repository->findOrFail($id, ['addresses', 'phoneNumbers', 'emails']),
        ]);
    }

    /**
     * @param int $id
     * @param StoreContact $request
     * @return JsonResponse
     */
    public function update(int $id, StoreContact $request): JsonResponse
    {
        if (! $this->repository->update($id, $request->only(['name', 'surname', 'note']))) {
            return response()->json([], 400);
        }

        return response()->json([], 200);
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
