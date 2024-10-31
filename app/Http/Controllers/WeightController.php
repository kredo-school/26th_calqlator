<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Weight;

class WeightController extends Controller
{
    private $weight;

    public function __construct(Weight $weight) {
        $this->weight = $weight;
    }

    public function weight(){
        return view('users.weight');
    }

    public function showChart()
    {
        $data = Weight::select('date', 'weight')->get();
        $formattedData = $data->map(function($item) {
            return [
                'date' => $item->date,
                'weight' => $item->weight
            ];
        });

        return view('weightChart')->with('data', $formattedData);
    }
}
