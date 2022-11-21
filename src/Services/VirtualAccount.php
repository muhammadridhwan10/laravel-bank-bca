<?php

namespace Ridhwan\LaravelBankBca\Services;

use Ridhwan\LaravelBankBca\Bca;

class VirtualAccount extends Bca
{
    /**
     * FundTransfer
     *
     * @param  array $fields
     * @return \Ridhwan\Response\Response
     */
    public function TransferVA(array $fields)
    {
        $requestUrl = '/banking/corporates/transfers';
        return $this->sendRequest('POST', $requestUrl, $fields);
    }

    /**
     * BillPresentment
     *
     * @param  array $fields
     * @return \Ridhwan\Response\Response
     */
    public function BillPresentment(array $fields)
    {
        $requestUrl = '/openapi/v1.0/transfer-va/inquiry';
        return $this->sendRequest('POST', $requestUrl, $fields);
    }
}
