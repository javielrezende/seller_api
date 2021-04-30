<?php

namespace App\Exceptions;

use Exception;

class SellerNotFoundException extends Exception
{
    public function handle()
    {
        return response()->json(
            [
                'code' => 'seller_not_found',
                'message' => 'Vendedor não encontrado',
            ], 404);
    }
}
