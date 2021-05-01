<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeller;
use App\Http\Services\Seller\SellerServiceContract;
use App\Traits\LogTrait;
use Exception;
use Illuminate\Http\JsonResponse;

class SellerController extends Controller
{
    use LogTrait;

    private $sellerService;

    /**
     * __construct
     *
     * @param  SellerServiceContract $sellerService
     */
    public function __construct(SellerServiceContract $sellerService)
    {
        $this->sellerService = $sellerService;
    }

    /**
     * List Sellers
     *
     * @return JsonResponse
     */
    public function list()
    {
        try {
            $sellers = $this->sellerService->getAllWithCommission();

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
            $seller = $this->sellerService->create($request);

            return new JsonResponse([
                'code' => 'seller_created',
                'message' => 'Vendedor cadastrado',
                'data' => $seller
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
