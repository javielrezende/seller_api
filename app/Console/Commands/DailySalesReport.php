<?php

namespace App\Console\Commands;

use App\Http\Repositories\Sale\SaleRepositoryContract;
use App\Mail\Report;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class DailySalesReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:DailySalesReport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    private $saleRepository;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(SaleRepositoryContract $saleRepository)
    {
        parent::__construct();
        $this->saleRepository = $saleRepository;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sales = $this->saleRepository->getSalesReportOfTheDay();

        $salesAmount = 0;
        $salesTotalPrice = 0;

        foreach($sales as $sale) {
            $salesAmount++;
            $salesTotalPrice += $sale->price;
        }

        $data = [
            'salesAmount' => $salesAmount,
            'salesTotalPrice' => number_format($salesTotalPrice, 2, ',', '.'),
            'day' => Carbon::now()->format('d-m-Y'),
        ];

        $emailReport = new Report($data);
        Mail::to('financial@tray.com')->send($emailReport);
    }
}
