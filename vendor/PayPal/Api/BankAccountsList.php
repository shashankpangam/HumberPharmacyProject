<?php

namespace PayPal\Api;

use PayPal\Common\PPModel;
use PayPal\Rest\ApiContext;

/**
 * Class BankAccountsList
 *
 * A list of Bank Account Resources
 *
 * @package PayPal\Api
 *
 * @property \PayPal\Api\BankAccount bank_accounts
 * @property int count
 * @property string next_id
 */
class BankAccountsList extends PPModel
{
    /**
     * A list of bank account resources
     * 
     *
     * @param \PayPal\Api\BankAccount $bank_accounts
     * 
     * @return $this
     */
    public function setBankAccounts($bank_accounts)
    {
        $this->{"bank-accounts"} = $bank_accounts;
        return $this;
    }

    /**
     * A list of bank account resources
     *
     * @return \PayPal\Api\BankAccount[]
     */
    public function getBankAccounts()
    {
        return $this->{"bank-accounts"};
    }

    /**
     * A list of bank account resources
     *
     * @deprecated Instead use setBankAccounts
     *
     * @param \PayPal\Api\BankAccount $bank-accounts
     * @return $this
     */
    public function setBank_accounts($bank_accounts)
    {
        $this->{"bank-accounts"} = $bank_accounts;
        return $this;
    }

    /**
     * A list of bank account resources
     * @deprecated Instead use getBankAccounts
     *
     * @return \PayPal\Api\BankAccount
     */
    public function getBank_accounts()
    {
        return $this->{"bank-accounts"};
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer items than the requested number of items.
     * 
     *
     * @param int $count
     * 
     * @return $this
     */
    public function setCount($count)
    {
        $this->count = $count;
        return $this;
    }

    /**
     * Number of items returned in each range of results. Note that the last results range could have fewer items than the requested number of items.
     *
     * @return int
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Identifier of the next element to get the next range of results.
     * 
     *
     * @param string $next_id
     * 
     * @return $this
     */
    public function setNextId($next_id)
    {
        $this->next_id = $next_id;
        return $this;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @return string
     */
    public function getNextId()
    {
        return $this->next_id;
    }

    /**
     * Identifier of the next element to get the next range of results.
     *
     * @deprecated Instead use setNextId
     *
     * @param string $next_id
     * @return $this
     */
    public function setNext_id($next_id)
    {
        $this->next_id = $next_id;
        return $this;
    }

    /**
     * Identifier of the next element to get the next range of results.
     * @deprecated Instead use getNextId
     *
     * @return string
     */
    public function getNext_id()
    {
        return $this->next_id;
    }

}
