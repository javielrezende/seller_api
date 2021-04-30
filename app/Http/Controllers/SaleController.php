<?php

namespace App\Http\Controllers;

use App\Exceptions\SellerNotFoundException;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Services\Sale\SaleServiceContract;
use Exception;
use Illuminate\Http\JsonResponse;

class SaleController extends Controller
{
    private $saleService;

    public function __construct(SaleServiceContract $saleService)
    {
        $this->saleService = $saleService;
    }

    /**
     * Make a store
     *
     * @param  StoreSaleRequest $request
     * @return JsonResponse
     */
    public function store(StoreSaleRequest $request)
    {
        try {
            $sale = $this->saleService->sale($request);

            return new JsonResponse([
                'code' => 'sale_created',
                'message' => 'Venda efetuada',
                'data' => $sale
                ], 201);
        } catch (Exception $exception) {
            $this->criticalLog('Failed to create a sale', SaleController::class, $exception->getMessage());

            return new JsonResponse([
                'code' => 'sale_creation_error',
                'message' => 'Erro ao efetuar uma venda'
            ], 500);
        }
    }

    /**
     * Get sales by seller id
     *
     * @param  int $sellerId
     * @return JsonResponse
     */
    public function getSalesBySellerId(int $sellerId)
    {
        try {
            $sales = $this->saleService->getSalesBySellerId($sellerId);

            return new JsonResponse(['data' => $sales], 200);
        } catch(SellerNotFoundException $notFoundException){
            return $notFoundException->handle();
        }catch (Exception $exception) {
            $this->criticalLog('Failed to list sales from specif seller', SaleController::class, $exception->getMessage());

            return new JsonResponse([
                'code' => 'sales_from_seller_error',
                'message' => 'Erro ao retornar vendas de um vendedor'
            ], 500);
        }
    }
}
