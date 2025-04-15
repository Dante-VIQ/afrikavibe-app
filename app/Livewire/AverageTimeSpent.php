<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Activity;

class AverageTimeSpent extends Component
{

    public $period = 'daily';

    public $chartData = [];

    // $activity = \App\Models\Activity::create([
    //     'user_id' => Auth::id(),
    //     'session_id' => Session::getId(),
    //     'start_time' => now(),
    // ]);


    public function updatedPeriod()
    {
        $this->loadChartData();
    }

    public function loadChartData()
    {
        $data = $this->getAverageTimeSpent($this->period);

        $this->chartData = [
            'labels' => $data->pluck('date')->toArray(),
            'averageTimeSpent' => $data->pluck('average_time_spent')->toArray(),
            'percentChange' => $data->pluck('percent_change')->toArray(),
        ];

        $this->emit('chartUpdated', $this->chartData);
    }

    public function getAverageTimeSpent($period = 'daily')
    {
        $query = Activity::query();

        switch ($period) {
            
            case 'daily':
                $query->whereDate('created_at', '>=', now()->subDays(7));
                break;

            case 'weekly':
                $query->whereDate('created_at', '>=', now()->subWeeks(4));
                break;

            case 'monthly':
                $query->whereDate('created_at', '>=', now()->subMonths(12));
                break;

            case 'yearly':
                $query->whereDate('created_at', '>=', now()->subYears(5));
                break;

        }

        $data = $query
            ->selectRaw(
                '
        DATE(created_at) as date,
        SUM(time_spent) as total_time_spent,
        COUNT(DISTINCT session_id) as total_visitors
        ',
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        // calculate average time
        $result = $data->map(function ($item, $key) use ($data) {
            $item->average_time_spent = $item->total_visitors > 0 ? round($item->total_time_spent / $item->total_visitors, 2) : 0;

            if ($key == 0) {
                $item->percent_change = 0;
            } else {
                $previous = $data[$key - 1];

                $item->percent_change = $previous->average_time_spent > 0 ? round((($item->average_time_spent - $previous->average_time_spent) / $previous->average_time_spent) * 100, 2) : 0;
            }

            return $item;
        });
        return $result;
    }
    public function calculatePercentageChange($current, $previous)
    {
        if($previous == 0) {
            return $current > 0 ? 100 : 0;
        }
        return round((($current - $previous) / $previous) * 100, 2);
    }
    public function render()
    {
        return view('livewire.average-time-spent');
    }
}
