<?php
require_once "public/finance/functions/generalFunctions.php";

function getAllInvestors()
{
    $db = Database::getInstance();
    $conn = $db->connect();

    $AP = getAccountCode("Capital Accounts");
    $sql = "SELECT * FROM ledger WHERE accounttype = :AP";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':AP', $AP);
    $stmt->execute();
    $ledgers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $results = [];
    foreach ($ledgers as $ledger) {
        $ledgerNo = $ledger['ledgerno'];
        $name = $ledger['name'];

        $query1 = "SELECT SUM(lt.amount) as total_amount 
                  FROM ledgertransaction lt 
                  JOIN ledger l ON lt.LedgerNo_Dr = l.ledgerno 
                  WHERE lt.LedgerNo = :LedgerNo AND l.AccountType != 2";

        $query2 = "SELECT SUM(lt.amount) as total_amount 
                  FROM ledgertransaction lt 
                  JOIN ledger l ON lt.LedgerNo_Dr = l.ledgerno 
                  WHERE lt.LedgerNo = :LedgerNo AND l.AccountType = 2";

        $stmt1 = $conn->prepare($query1);
        $stmt1->bindParam(':LedgerNo', $ledgerNo);
        $stmt1->execute();
        $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':LedgerNo', $ledgerNo);
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        $total_amount = $result1['total_amount'] - $result2['total_amount'];

        $results[] = [
            'ledgerno' => $ledgerNo,
            'name' => $name,
            'total_amount' => $total_amount
        ];
    }

    return $results;
}

function getAllPayable()
{
    $db = Database::getInstance();
    $conn = $db->connect();

    $AP = getAccountCode("Accounts Payable");
    $TP = getAccountCode("Tax Payable");
    $sql = "SELECT * FROM ledger WHERE accounttype = :AP OR accounttype = :TP";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':AP', $AP);
    $stmt->bindParam(':TP', $TP);
    $stmt->execute();
    $ledgers = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $results = [];
    foreach ($ledgers as $ledger) {
        $ledgerNo = $ledger['ledgerno'];
        $name = $ledger['name'];

        $query1 = "SELECT SUM(lt.amount) as total_amount 
                  FROM ledgertransaction lt 
                  JOIN ledger l ON lt.LedgerNo_Dr = l.ledgerno 
                  WHERE lt.LedgerNo = :LedgerNo AND l.AccountType != 2";

        $query2 = "SELECT SUM(lt.amount) as total_amount 
                  FROM ledgertransaction lt 
                  JOIN ledger l ON lt.LedgerNo_Dr = l.ledgerno 
                  WHERE lt.LedgerNo = :LedgerNo AND l.AccountType = 2";

        $stmt1 = $conn->prepare($query1);
        $stmt1->bindParam(':LedgerNo', $ledgerNo);
        $stmt1->execute();
        $result1 = $stmt1->fetch(PDO::FETCH_ASSOC);

        $stmt2 = $conn->prepare($query2);
        $stmt2->bindParam(':LedgerNo', $ledgerNo);
        $stmt2->execute();
        $result2 = $stmt2->fetch(PDO::FETCH_ASSOC);

        $total_amount = $result1['total_amount'] - $result2['total_amount'];

        $results[] = [
            'ledgerno' => $ledgerNo,
            'name' => $name,
            'total_amount' => $total_amount
        ];
    }

    return $results;
}


// get total value of payble minus the paid amount
function getValueOfPayable($accountNumber)
{
    return abs(getAccountBalanceV2($accountNumber));
}


// add loan to account
function borrowAsset($accountNumber, $assetCode, $amount)
{
    $accountNumber = getAccountCode($accountNumber);
    $assetCode = getAccountCode($assetCode);

    if ($amount <= 0) {
        throw new Exception("Amount must be greater than 0");
    }
    if (!$accountNumber) {
        throw new Exception("Account number not found");
    }
    if (!$assetCode) {
        throw new Exception("Asset code not found");
    }

    insertLedgerXact($assetCode, $accountNumber, $amount, "Boroww on $accountNumber with $assetCode");
    return;
}

//withdraw investment 
function payPayable($accountNumber, $assetCode, $amount)
{
    $accountNumber = getAccountCode($accountNumber);
    $assetCode = getAccountCode($assetCode);

    $currentPayable = getValueOfPayable($accountNumber);

    if ($amount <= 0) {
        throw new Exception("Amount must be greater than 0");
    }
    if ($amount > $currentPayable) {
        throw new Exception("Amount is greater than current payable");
    }
    if (!$accountNumber) {
        throw new Exception("Account number not found");
    }
    if (!$assetCode) {
        throw new Exception("Asset code not found");
    }

    insertLedgerXact($accountNumber, $assetCode, $amount, "Paid $accountNumber using $assetCode");
    return;
}

function addPayable($name, $contact, $contactName)
{
    $CAPITAL = getAccountCode("Accounts Payable");

    $db = Database::getInstance();
    $conn = $db->connect();

    $sql = "INSERT INTO Ledger (name, contactIfLE, contactName, accounttype) VALUES (:name, :contact, :contactName, :CAPITAL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':contactName', $contactName);
    $stmt->bindParam(':CAPITAL', $CAPITAL);
    $stmt->execute();
    return;
}


function payInvestor($accountNumber, $assetCode, $amount)
{
    $accountNumber = getAccountCode($accountNumber);
    $assetCode = getAccountCode($assetCode);

    $currentPayable = getValueOfPayable($accountNumber);

    if ($amount <= 0) {
        throw new Exception("Amount must be greater than 0");
    }
    if ($amount > $currentPayable) {
        throw new Exception("Amount is greater than current payable");
    }
    if (!$accountNumber) {
        throw new Exception("Account number not found");
    }
    if (!$assetCode) {
        throw new Exception("Asset code not found");
    }

    insertLedgerXact($accountNumber, $assetCode, $amount, "Paid $accountNumber using $assetCode");
    return;
}

function addInvestor($name, $contact, $contactName)
{
    $CAPITAL = getAccountCode("Capital Accounts");

    $db = Database::getInstance();
    $conn = $db->connect();

    $sql = "INSERT INTO Ledger (name, contactIfLE, contactName, accounttype) VALUES (:name, :contact, :contactName, :CAPITAL)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':contact', $contact);
    $stmt->bindParam(':contactName', $contactName);
    $stmt->bindParam(':CAPITAL', $CAPITAL);
    $stmt->execute();
    return;
}