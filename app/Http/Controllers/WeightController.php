<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use DateTime;


class WeightController extends Controller
{
    private $weight;

    public function __construct(Weight $weight) {
        $this->weight = $weight;
    }

    public function weight(){
        $today = Carbon::today();

        $todayWeight = $this->weight
                            ->where('user_id', Auth::user()->id)
                            ->whereDate('date', $today)
                            ->first();

        return view('users.weight')->with('todayWeight', $todayWeight);
    }

    public function weightChart(){
        try{
        // $today = now()->format('Y-m-d');
        $today = Carbon::today();
        $firstDayOfMonth = $today->copy()->startOfMonth();
        $secondMonthsAgo = $firstDayOfMonth->copy()->subMonths(6);
        $lastDayOfMonth = $today->copy()->endOfMonth();

        $weights = $this->weight
                        ->where('user_id', Auth::user()->id)
                        ->whereBetween('date', [$secondMonthsAgo, $lastDayOfMonth])
                        ->orderBy('date', 'asc')
                        ->limit(200)
                        ->get();

        $weightData=[];
        foreach($weights as $weight){
            $date = Carbon::parse($weight->date);
            $weightData[] = [
                'date' => $date->format('Y-m-d'),
                'weight' => $weight->weight
            ];
        }
        return response()->json($weightData);
    } catch (\Exception $e) {
        Log::error('Error fetching weight chart data: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
    }
}
