<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEmail;
use App\Repositories\EmailsRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ContactEmailsController extends Controller
{
    /**
     * @var EmailsRepository
     */
    private $repository;

    /**
     * @param EmailsRepository $repository
     */
    public function __construct(EmailsRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $contactId
     * @param StoreEmail $request
     * @return JsonResponse
     */
    public function store(int $contactId, StoreEmail $request): JsonResponse
    {
        if ($request->get('primary')) {
            $this->makeSecondary($contactId);
        }

        $this->repository->create([
            'contact_id' => $contactId,
            'email' => $request->get('email'),
            'primary' => $request->get('primary', 0)
        ]);

        return response()->json([], 201);
    }

    /**
     * @param int $contactId
     * @param int $emailId
     * @param StoreEmail $request
     * @return JsonResponse
     */
    public function update(int $contactId, int $emailId, StoreEmail $request): JsonResponse
    {
        try {
            $email = $this->repository->firstOrFail(['contact_id' => $contactId, 'id' => $emailId]);

            if ($request->get('primary')) {
                $this->makeSecondary($contactId);
            }

            $email->update($request->only(['email', 'primary']));
            return response()->json([], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([], 404);
        }
    }

    /**
     * @param int $contactId
     * @param int $emailId
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $contactId, int $emailId): JsonResponse
    {
        try {
            $this->repository->firstOrFail(['contact_id' => $contactId, 'id' => $emailId, 'primary' => 0])->delete();
            return response()->json([], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([], 404);
        }
    }

    /**
     * @param int $contactId
     * @return int
     */
    private function makeSecondary(int $contactId): int
    {
        return $this->repository->change(['contact_id' => $contactId], ['primary' => 0]);
    }
}
