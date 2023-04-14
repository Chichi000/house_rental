<?php

namespace App\Http\Controllers;

use App\Charts\ProfitChart;
use App\Charts\PropertyChart;
use App\Charts\PaymentChart;
use App\Charts\UserChart;
use App\Models\Landlord;
use App\Models\Order;
use App\Models\User;
use DB;

class DashboardController extends Controller
{
    public function demographicChart()
    {
        $propChart = DB::table('properties')
            ->join('landlords', 'properties.landlord_id', 'landlords.id')
            ->groupBy('landlords.last_name')
            ->pluck(DB::raw('count(landlords.last_name) as total'), 'landlords.last_name')
            ->toArray();

        $totalPropChart = new PropertyChart;

        $dataset = $totalPropChart->labels(array_keys($propChart));

        $dataset = $totalPropChart->dataset('Total Properties of landlord', 'bar', array_values($propChart));
        $dataset = $dataset->backgroundColor(collect([
            '#cb0c9f','#8392ab', '#17c1e8',"#82d616", "#ea0606", "#f53939", "#e9ecef", 
            "#252f40", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $totalPropChart->options([
            'responsive' => true,
            'tooltips' => ['enabled' => true],

            'title' => [
                'display' => true,
                'text' => 'Chart.js Floating Bar Chart',
            ],

            'aspectRatio' => 1,
            'scales' => [
                'yAxes' => [[
                    'display' => true,
                    'ticks' => ['beginAtZero' => true],
                    'gridLines' => ['display' => true],
                ]],
                'xAxes' => [[
                    'categoryPercentage' => 0.8,
                    //'barThickness' => 100,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true,

                ]],

            ],
        ]);

        $usersChart = DB::table('users')
            ->groupBy('role')
            ->pluck(DB::raw('count(role) as total'), 'role')
            ->toArray();

        $totalUsersChart = new UserChart;

        $dataset = $totalUsersChart->labels(array_keys($usersChart));

        $dataset = $totalUsersChart->dataset('Total users', 'doughnut', array_values($usersChart));
        $dataset = $dataset->backgroundColor(collect([
            '#cb0c9f','#8392ab', '#17c1e8',"#82d616", "#ea0606", "#f53939", "#e9ecef", 
            "#252f40", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $totalUsersChart->options([
            'responsive' => true,
            'tooltips' => ['enabled' => true],

            'title' => [
                'display' => true,
                'text' => 'Chart.js Floating Bar Chart',
            ],

            'aspectRatio' => 1,
            'scales' => [
                'yAxes' => [[
                    'display' => true,
                    'ticks' => ['beginAtZero' => true],
                    'gridLines' => ['display' => true],
                ]],
                'xAxes' => [[
                    'categoryPercentage' => 0.8,
                    'barPercentage' => 1,
                    'ticks' => ['beginAtZero' => false],
                    'gridLines' => ['display' => true],
                    'display' => true,

                ]],

            ],
        ]);

        // SINGLE CHART

        $profitChartData = DB::table('orderinfo')
        ->where('status', '=', 'Accepted')
        ->selectRaw('DATE_FORMAT(created_at, "%M, %Y") as month, SUM(total_amount) as total_profit')
        ->groupBy('month')
        ->orderByRaw('MONTH(created_at) ASC')
        ->get()
        ->toArray();

    // Create a new line chart instance
    $profitChart = new ProfitChart;

    // Set the chart labels to the dates extracted from the profitChartData array
    $profitChart->labels(array_column($profitChartData, 'month'));

    // Add a dataset to the chart representing the total profit values
    $profitChart->dataset('Total Profit in month', 'line', array_column($profitChartData, 'total_profit'))
        ->backgroundColor('#7158e2')
        ->color('#7158e2')
        ->lineTension(0.3);

    // Set chart options
    $profitChart->options([
        'responsive' => true,
        'tooltips' => [
            'enabled'=> true,
        ],
        'title' => [
            'display'=> true,
            'text' => 'Total Profit Chart',
        ],
        'scales' => [
            'yAxes'=> [[
                'display'=>true,
                'ticks'=> [
                    'beginAtZero'=> true,
                ],
                'gridLines'=> [
                    'display'=> true,
                ],
            ]],
            'xAxes'=> [[
                'display' => true,
                'gridLines' => [
                    'display' => false,
                ],
            ]],
        ],
    ]);


        //payment chart

        $paymentChart = DB::table('orderinfo')
            ->groupBy('payment_method')
            ->pluck(DB::raw('count(payment_method) as total'),'payment_method')
            ->toArray();
        
            $mostpmChart = new PaymentChart;

        $dataset = $mostpmChart->labels(array_keys($paymentChart));

        $dataset = $mostpmChart->dataset('Most Payment Method Used', 'pie', array_values($paymentChart));
        $dataset = $dataset->backgroundColor(collect([
        '#cb0c9f','#8392ab', '#17c1e8',"#82d616", "#ea0606", "#f53939", "#e9ecef", 
        "#252f40", "#39CCCC", "#01FF70", "#85144b", "#F012BE", "#3D9970", "#111111", "#AAAAAA"]));

        $mostpmChart->options([
            'responsive' => true,
            'tooltips' => ['enabled'=> true],

            'title' => [
                'display'=> true,
                'text' => 'Chart.js Floating Bar Chart'
            ],

            'aspectRatio' => 1,
            'scales' => [
                'yAxes'=> [[
                            'display'=>true,
                            'ticks'=> ['beginAtZero'=> true],
                            'gridLines'=> ['display'=> true],
                        ]],
                'xAxes'=> [[
                            'categoryPercentage'=> 0.8,
                            'barPercentage' => 1,
                            'ticks' => ['beginAtZero' => false],
                            'gridLines' => ['display' => true],
                            'display' => true

                        ]],

                ],
        ]);

        $totalUser = DB::table('users')
            ->groupBy('role')
            ->pluck(DB::raw('count(role) as total'), 'role')
            ->toArray();
        // dd($totalUser['admin']);

        // Get the latest 10 new tenant and landlord accounts
        $newUsers = User::orderBy('created_at', 'desc')->take(10)->get();
        $newLandlords = Landlord::orderBy('created_at', 'desc')->take(10)->get();

        // Get the latest 10 order information
        $orders = Order::with('tenants')->orderBy('created_at', 'desc')->take(10)->get();

        return view('dashboard.index', compact('totalPropChart', 'totalUsersChart', 'totalUser', 'newUsers', 'newLandlords', 'orders', 'profitChart', 'mostpmChart'));
    }
}
