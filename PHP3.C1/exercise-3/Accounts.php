<?php

class Accounts
{
    public int $id;
    public string $name;
    public float $balance;

    public function __construct(int $id, string $name, float $balance)
    {
        $this->id = $id;
        $this->name = $name;
        $this->balance = $balance;
    }

    public function addCredit(float $credit):void
    {
        $this->balance += $credit;
    }

    public function subtractDebit(float $debit):void
    {
        $this->balance -= $debit;
    }

    public function displayBalance():void
    {
        echo $this->balance;
    }

    public function transferCredit(Accounts $account, float $transferAmount):Accounts
    {
        $this->balance -= $transferAmount;
        $account->balance += $transferAmount;

        return $account;
    }
}

$account1 = new Accounts(1,"John",1000);
$account1->displayBalance();
echo PHP_EOL;

$account2 = new Accounts(2,"Jenny",2000);
$account2->displayBalance();
echo PHP_EOL;

$account1->transferCredit($account2,500);
echo PHP_EOL;

$account1->displayBalance();
echo PHP_EOL;
$account2->displayBalance();
echo PHP_EOL;

var_dump($account1);

echo PHP_EOL;

var_dump($account2);