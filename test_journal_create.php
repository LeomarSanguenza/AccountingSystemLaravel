<?php
// Quick script to test journal create method
// Run this with: php test_journal_create.php

require_once 'vendor/autoload.php';

// Bootstrap Laravel
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Http\Controllers\JournalController;
use App\Models\ExpenseType;
use Illuminate\Support\Facades\DB;
use App\Models\Payee;
use App\Models\Tag;
use App\Models\AccountCode;
use App\Models\Office;

echo "Testing JournalController create method...\n\n";

try {
    // Test each model individually
    echo "Testing ExpenseType model...\n";
    $expenseTypes = ExpenseType::pluck('name', 'id');
    echo "ExpenseTypes count: " . $expenseTypes->count() . "\n";

    echo "Testing FundType via direct query...\n";
    $fundTypes = DB::connection('mysql')->table('fund_types')->pluck('description', 'id');
    echo "FundTypes count: " . $fundTypes->count() . "\n";

    echo "Testing Payee model...\n";
    $payees = Payee::pluck('payee_name', 'id');
    echo "Payees count: " . $payees->count() . "\n";

    echo "Testing Tag model...\n";
    $tags = Tag::pluck('description', 'tags_id');
    echo "Tags count: " . $tags->count() . "\n";

    echo "Testing AccountCode model...\n";
    $accounts = AccountCode::pluck('description', 'full_code');
    echo "AccountCodes count: " . $accounts->count() . "\n";

    echo "Testing Office model...\n";
    $offices = Office::pluck('office_name', 'id');
    echo "Offices count: " . $offices->count() . "\n";

    echo "\nAll models loaded successfully!\n";

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}