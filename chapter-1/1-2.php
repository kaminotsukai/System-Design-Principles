<?php

/**
 * 【複雑さを閉じ込める】
 */


/**
 * 顧客一覧
 */
class Collection
{
    /**
     * @var Customer[]
     */
    public array $customers = [];

    public function __construct()
    {
        $this->customers = [];
    }


    // ===================================
    // コレクションの基本操作
    // ===================================

    public function add(Customer $customer)
    {
        $this->customers[] = $customer;
    }

    public function removeIfExists(Customer $customer)
    {
        //
    }

    public function count()
    {
        return count($this->customers);
    }

    // ===================================
    // ドメインロジック
    // ===================================

    public function importantCustomer()
    {
        //
    }
}