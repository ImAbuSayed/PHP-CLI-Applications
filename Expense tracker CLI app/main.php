<?php
class Transaction
{
    public $amount;
    public $category;
    public $description;

    public function __construct($amount, $category, $description)
    {
        $this->amount = $amount;
        $this->category = $category;
        $this->description = $description;
    }

    public function display()
    {
        echo "Amount: $this->amount, Category: $this->category, Description: $this->description\n";
    }
}

class TransactionManager
{
    private $transactions = [];
    private $filename;

    public function __construct($filename)
    {
        $this->filename = $filename;
        $this->loadData();
    }

    public function addTransaction($amount, $category, $description)
    {
        $transaction = new Transaction($amount, $category, $description);
        $this->transactions[] = $transaction;
        $this->saveData();
    }

    public function viewTransactions()
    {
        foreach ($this->transactions as $transaction) {
            $transaction->display();
        }
    }

    public function updateTransaction($index, $amount, $category, $description)
    {
        if (isset($this->transactions[$index])) {
            $this->transactions[$index]->amount = $amount;
            $this->transactions[$index]->category = $category;
            $this->transactions[$index]->description = $description;
            $this->saveData();
        } else {
            echo "Transaction index not found.\n";
        }
    }

    private function saveData()
    {
        file_put_contents($this->filename, serialize($this->transactions));
    }

    private function loadData()
    {
        if (file_exists($this->filename)) {
            $this->transactions = unserialize(file_get_contents($this->filename));
        }
    }
}

// Usage example
$transactionManager = new TransactionManager('transactions.dat');

while (true) {
    echo "1. Add Transaction\n";
    echo "2. View Transactions\n";
    echo "3. Update Transaction\n";
    echo "4. Exit\n";

    $choice = readline("Enter your choice: ");

    switch ($choice) {
        case 1:
            $amount = readline("Enter amount: ");
            $category = readline("Enter category: ");
            $description = readline("Enter description: ");
            $transactionManager->addTransaction($amount, $category, $description);
            break;
        case 2:
            $transactionManager->viewTransactions();
            break;
        case 3:
            $index = readline("Enter the index of the transaction to update: ");
            $amount = readline("Enter new amount: ");
            $category = readline("Enter new category: ");
            $description = readline("Enter new description: ");
            $transactionManager->updateTransaction($index, $amount, $category, $description);
            break;
        case 4:
            exit();
        default:
            echo "Invalid choice. Please try again.\n";
    }
}
