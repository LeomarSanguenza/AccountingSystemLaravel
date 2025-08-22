<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PartSumsController extends Controller
{
    public function index()
    {
        return view('partsums.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'numbers' => 'required|string'
        ]);

        // Convert input string into an array of numbers
        $numbers = array_map('intval', explode(',', $request->numbers));

        $result = $this->partSums($numbers);

        return view('partsums.index', compact('result', 'numbers'));
    }

    private function partSums(array $ls)
    {
        $sum = array_sum($ls);
        $sums = [$sum];

        foreach ($ls as $num) {
            $sum -= $num;
            $sums[] = $sum;
        }

        return $sums;
    }
}
