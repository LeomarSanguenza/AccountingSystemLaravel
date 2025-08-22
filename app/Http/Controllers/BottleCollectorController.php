<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BottleCollectorController extends Controller
{
    public function index()
    {
        return view('bottlecollector.index');
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'daily_expenses' => 'required|numeric|min:0',
            'expeditions' => 'required|string'
        ]);

        $daily_expenses = (float) $request->daily_expenses;
        $expedition_lines = explode("\n", trim($request->expeditions));

        $total_earnings = 0;
        $days = count($expedition_lines);

        foreach ($expedition_lines as $expedition) {
            [$hours, $path, $price] = explode(' ', $expedition);
            $hours = (int) $hours;
            $price = (float) $price;

            $bottles_collected = $this->calculateBottles($hours, $path);
            $total_earnings += $bottles_collected * $price;
        }

        $average_earnings = $total_earnings / $days;
        $total_daily_expenses = $daily_expenses * $days;
        $difference = round(abs($average_earnings - $daily_expenses), 2);

        if ($average_earnings > $daily_expenses) {
            $message = "Good earnings. Extra money per day: " . number_format($difference, 2);
        } else {
            $message = "Hard times. Money needed: " . number_format($total_daily_expenses - $total_earnings, 2);
        }

        return view('bottlecollector.index', compact('total_earnings', 'average_earnings', 'message', 'daily_expenses', 'expedition_lines'));
    }

    private function calculateBottles($hours, $path)
    {
        $path_length = strlen($path);
        $full_loops = (int) ($hours / $path_length);
        $remaining_hours = $hours % $path_length;

        $bottles_per_loop = substr_count($path, 'B');
        $extra_bottles = substr_count(substr($path, 0, $remaining_hours), 'B');

        return ($bottles_per_loop * $full_loops) + $extra_bottles;
    }
}
