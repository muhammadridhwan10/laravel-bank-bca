<?php

namespace Ridhwan\LaravelBankBca\Services;

use Ridhwan\LaravelBankBca\Bca;

class BusinessBanking extends Bca
{
    /**
     * __construct
     *
     * @param  string $token
     * @return void
     */
    public function __construct($token)
    {
        parent::__construct($token);
    }

    /**
     * BalanceInformation
     *
     * @param  string $AccountNumber
     * @return \Ridhwan\Response\Response
     */
    public function BalanceInformation(string $AccountNumber)
    {
        $requestUrl = "/banking/v3/corporates/{$this->corporateID}/accounts/{$AccountNumber}";
        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * AccountStatement
     *
     * @param  string $AccountNumber
     * @param  string $startDate
     * @param  string $endDate
     * @return \Ridhwan\Response\Response
     */
    public function AccountStatement(string $AccountNumber, string $startDate, string $endDate)
    {
        $requestUrl = "/banking/v3/corporates/{$this->corporateID}/accounts/{$AccountNumber}/statements?StartDate={$startDate}&EndDate={$endDate}";
        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * FundTransfer
     *
     * @param  array $fields
     * @return \Ridhwan\Response\Response
     */
    public function FundTransfer(array $fields)
    {
        $fields = array_merge(
            $fields,
            ['CorporateID' => $this->corporateID, 'TransactionDate' => date('Y-m-d')]
        );

        $fields['Remark1'] = strtolower(str_replace(' ', '', $fields['Remark1']));
        $fields['Remark2'] = strtolower(str_replace(' ', '', $fields['Remark2']));

        $requestUrl = '/banking/corporates/transfers';
        return $this->sendRequest('POST', $requestUrl, $fields);
    }

    /**
     * FundTransfer
     *
     * @param  string $TransactionNumber
     * @param  string $TransactionDate
     * @return \Ridhwan\Response\Response
     */
    public function StatusTransfer(string $TransactionNumber, string $TransactionDate)
    {
        $requestUrl = "/banking/corporates/transfers/status/{$TransactionNumber}?TransactionDate={$TransactionDate}&TransferType=BCA";
        return $this->sendRequest('GET', $requestUrl);
    }

    /**
     * Dynamiclly set corporate ID
     *
     * @param  string $corporateID
     * @return $this
     */
    public function setCorporateID(string $corporateID)
    {
        $this->corporateID = $corporateID;

        return $this;
    }
}
