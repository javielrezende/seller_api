<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Report extends Mailable
{
    use Queueable, SerializesModels;

    public $subject = 'Relatório diário de vendas';
    public $dataToreport;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->dataToreport = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $salesAmount = $this->dataToreport['salesAmount'];
        $salesTotalPrice = $this->dataToreport['salesTotalPrice'];
        $day = $this->dataToreport['day'];

        return $this->view('report', compact('salesAmount', 'salesTotalPrice', 'day'));
    }
}
