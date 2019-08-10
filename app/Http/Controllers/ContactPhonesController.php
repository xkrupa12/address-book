<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePhoneNumber;
use App\Repositories\PhoneNumbersRepository;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;

class ContactPhonesController extends Controller
{
    /**
     * @var PhoneNumbersRepository
     */
    private $repository;

    /**
     * @param PhoneNumbersRepository $repository
     */
    public function __construct(PhoneNumbersRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $contactId
     * @param StorePhoneNumber $request
     * @return JsonResponse
     */
    public function store(int $contactId, StorePhoneNumber $request): JsonResponse
    {
        if ($request->get('primary')) {
            $this->makeSecondary($contactId);
        }

        $this->repository->create([
            'contact_id' => $contactId,
            'phone_number' => $request->get('phone_number'),
            'primary' => $request->get('primary', 0)
        ]);

        return response()->json([], 201);
    }

    /**
     * @param int $contactId
     * @param int $phoneId
     * @param StorePhoneNumber $request
     * @return JsonResponse
     */
    public function update(int $contactId, int $phoneId, StorePhoneNumber $request): JsonResponse
    {
        try {
            $phone = $this->repository->firstOrFail(['contact_id' => $contactId, 'id' => $phoneId]);

            if ($request->get('primary')) {
                $this->makeSecondary($contactId);
            }

            $phone->update($request->only(['phone_number', 'primary']));
            return response()->json([], 200);
        } catch (ModelNotFoundException $e) {
            return response()->json([], 404);
        }
    }

    /**
     * @param int $contactId
     * @param int $phoneId
     * @return JsonResponse
     * @throws Exception
     */
    public function delete(int $contactId, int $phoneId): JsonResponse
    {
        try {
            $phone = $this->repository->firstOrFail([
                'contact_id' => $contactId,
                'id' => $phoneId,
                'primary' => false // let's not allow deleting primary phone number
            ]);

            $phone->delete();
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
