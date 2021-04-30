<?php

namespace App\Http\Controllers;

use App\Http\Repositories\Seller\SellerRepositoryContract;
use App\Http\Requests\StoreSeller;
use App\Traits\LogTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    use LogTrait;

    private $sellerRepository;

    /**
     * __construct
     *
     * @param  SellerRepositoryContract $sellerRepository
     */
    public function __construct(SellerRepositoryContract $sellerRepository)
    {
        $this->sellerRepository = $sellerRepository;
    }

    /**
     * List Sellers
     *
     * @return JsonResponse
     */
    public function list()
    {
        try {
            $sellers = $this->sellerRepository->all();

            return new JsonResponse(['data' => $sellers], 200);
        } catch (Exception $exception) {
            $this->criticalLog('Failed to list sellers', SellerController::class, $exception->getMessage());

            return new JsonResponse([
                'code' => 'seller_list_error',
                'message' => 'Erro ao listar vendedores'
            ], 500);
        }
    }

    /**
     * Store a Seller
     *
     * @param  StoreSeller $request
     * @return void
     */
    public function store(StoreSeller $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email
            ];

            $this->sellerRepository->create($data);

            return new JsonResponse([
                'code' => 'seller_created',
                'message' => 'Vendedor cadastrado'
                ], 201);
        } catch (Exception $exception) {
            $this->criticalLog('Failed to create a seller', SellerController::class, $exception->getMessage());

            return new JsonResponse([
                'code' => 'seller_creation_error',
                'message' => 'Erro ao cadastrar um vendedor'
            ], 500);
        }
    }
}
