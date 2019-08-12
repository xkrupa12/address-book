<?php

namespace App\Http\Controllers;

use App\Repositories\AddressesRepository;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ContactAddressesController extends Controller
{
    /**
     * @var AddressesRepository
     */
    private $repository;

    /**
     * @param AddressesRepository $repository
     */
    public function __construct(AddressesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param int $contactId
     * @param Request $request
     * @return JsonResponse
     */
    public function store(int $contactId, Request $request): JsonResponse
    {
        try {
            $address = $this->repository->create(array_merge(
                ['contact_id' => $contactId],
                $request->only(['title', 'street', 'street_number', 'city', 'postcode', 'country'])
            ));
            return response()->json($address, 201);
        } catch (Exception $e) {
            return response()->json([], 400);
        }
    }

    /**
     * @param int $contactId
     * @param int $addressId
     * @return JsonResponse
     */
    public function setPrimary(int $contactId, int $addressId): JsonResponse
    {
        $address = $this->repository->firstOrFail(['contact_id' => $contactId, 'id' => $addressId]);

        $this->repository->change(['contact_id' => $contactId], ['primary' => 0]);
        $address->update(['primary' => 1]);

        return response()->json([], 200);
    }
}
