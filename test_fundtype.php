<?php
require_once 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\FundType;
use Illuminate\Support\Facades\DB;

echo "Testing FundType model...\n";
echo "Default connection: " . config('database.default') . "\n";
echo "Current database: " . DB::connection()->getDatabaseName() . "\n";

try {
    $fundType = new FundType();
    echo "FundType connection: " . $fundType->getConnectionName() . "\n";
    echo "FundType table: " . $fundType->getTable() . "\n";
    
    // Test direct query
    $count = DB::connection('mysql')->table('fund_types')->count();
    echo "Direct query count: " . $count . "\n";
    
    // Test model query
    $modelCount = FundType::count();
    echo "Model count: " . $modelCount . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}