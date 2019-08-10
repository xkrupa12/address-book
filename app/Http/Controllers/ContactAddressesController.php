<?php

namespace App\Http\Controllers;

use App\Repositories\AddressesRepository;
use Illuminate\Http\JsonResponse;

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
