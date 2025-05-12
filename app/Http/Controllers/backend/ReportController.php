<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Juice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Display sales report dashboard
     */
    public function index()
    {
        // Get sales summary for today, this week, and this month
        $todaySales = $this->getDailySalesData(Carbon::today());
        $weekSales = $this->getWeeklySalesData(Carbon::now()->startOfWeek());
        $monthSales = $this->getMonthlySalesData(Carbon::now()->startOfMonth());
        
        // Get top selling juices
        $topJuices = $this->getTopSellingJuices();
        
        // Get sales trend for last 30 days
        $salesTrend = $this->getSalesTrend();
        
        return view('backend.reports.index', compact(
            'todaySales', 
            'weekSales', 
            'monthSales', 
            'topJuices',
            'salesTrend'
        ));
    }
    
    /**
     * Display daily sales report
     */
    public function daily(Request $request)
    {
        $date = $request->date ? Carbon::parse($request->date) : Carbon::today();
        
        // Get sales data for the selected date
        $salesData = $this->getDailySalesData($date);
        
        // Get hourly sales breakdown
        $hourlySales = $this->getHourlySales($date);
        
        // Get sales by juice size
        $sizeData = $this->getSalesBySize($date);
        
        // Get popular juices for the day
        $popularJuices = $this->getPopularJuices($date);
        
        return view('backend.reports.daily', compact(
            'date', 
            'salesData', 
            'hourlySales', 
            'sizeData', 
            'popularJuices'
        ));
    }
    
    /**
     * Display weekly sales report
     */
    public function weekly(Request $request)
    {
        $startDate = $request->start_date 
            ? Carbon::parse($request->start_date) 
            : Carbon::now()->startOfWeek();
            
        $endDate = Carbon::parse($startDate)->addDays(6);
        
        // Get sales data for the selected week
        $salesData = $this->getWeeklySalesData($startDate);
        
        // Get daily sales breakdown for the week
        $dailySales = $this->getDailySalesForWeek($startDate, $endDate);
        
        // Get sales by juice size
        $sizeData = $this->getSalesBySize($startDate, $endDate);
        
        // Get popular juices for the week
        $popularJuices = $this->getPopularJuices($startDate, $endDate);
        
        return view('backend.reports.weekly', compact(
            'startDate', 
            'endDate', 
            'salesData', 
            'dailySales', 
            'sizeData', 
            'popularJuices'
        ));
    }
    
    /**
     * Display monthly sales report
     */
    public function monthly(Request $request)
    {
        $month = $request->month ? Carbon::parse($request->month.'-01') : Carbon::now()->startOfMonth();
        $startDate = Carbon::parse($month)->startOfMonth();
        $endDate = Carbon::parse($month)->endOfMonth();
        
        // Get sales data for the selected month
        $salesData = $this->getMonthlySalesData($startDate);
        
        // Get weekly sales breakdown for the month
        $weeklySales = $this->getWeeklySalesForMonth($startDate, $endDate);
        
        // Get sales by juice size
        $sizeData = $this->getSalesBySize($startDate, $endDate);
        
        // Get popular juices for the month
        $popularJuices = $this->getPopularJuices($startDate, $endDate);
        
        return view('backend.reports.monthly', compact(
            'month', 
            'salesData', 
            'weeklySales', 
            'sizeData', 
            'popularJuices'
        ));
    }
    
    /**
     * Get sales data for a specific date
     */
    private function getDailySalesData($date)
    {
        $orders = Order::whereDate('created_at', $date)->get();
        
        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $totalItems = OrderItem::whereIn('order_id', $orders->pluck('id'))->sum('quantity');
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        
        return [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'total_items' => $totalItems,
            'average_order' => $averageOrderValue,
            'date' => $date
        ];
    }
    
    /**
     * Get sales data for a specific week
     */
    private function getWeeklySalesData($startDate)
    {
        $endDate = Carbon::parse($startDate)->addDays(6);
        
        $orders = Order::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->get();
        
        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $totalItems = OrderItem::whereIn('order_id', $orders->pluck('id'))->sum('quantity');
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        
        return [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'total_items' => $totalItems,
            'average_order' => $averageOrderValue,
            'start_date' => $startDate,
            'end_date' => $endDate
        ];
    }
    
    /**
     * Get sales data for a specific month
     */
    private function getMonthlySalesData($startDate)
    {
        $endDate = Carbon::parse($startDate)->endOfMonth();
        
        $orders = Order::whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])->get();
        
        $totalSales = $orders->sum('total');
        $totalOrders = $orders->count();
        $totalItems = OrderItem::whereIn('order_id', $orders->pluck('id'))->sum('quantity');
        $averageOrderValue = $totalOrders > 0 ? $totalSales / $totalOrders : 0;
        
        return [
            'total_sales' => $totalSales,
            'total_orders' => $totalOrders,
            'total_items' => $totalItems,
            'average_order' => $averageOrderValue,
            'month' => $startDate,
        ];
    }
    
    /**
     * Get hourly sales breakdown for a specific date
     */
    private function getHourlySales($date)
    {
        $hourlyData = Order::selectRaw('HOUR(created_at) as hour, COUNT(*) as orders, SUM(total) as sales')
            ->whereDate('created_at', $date)
            ->groupBy('hour')
            ->orderBy('hour')
            ->get();
            
        $hours = [];
        $salesByHour = [];
        $ordersByHour = [];
        
        // Initialize all hours with 0 values
        for ($i = 0; $i < 24; $i++) {
            $hours[] = $i . ':00';
            $salesByHour[$i] = 0;
            $ordersByHour[$i] = 0;
        }
        
        // Fill in actual data
        foreach ($hourlyData as $data) {
            $salesByHour[$data->hour] = $data->sales;
            $ordersByHour[$data->hour] = $data->orders;
        }
        
        return [
            'hours' => $hours,
            'sales' => array_values($salesByHour),
            'orders' => array_values($ordersByHour)
        ];
    }
    
    /**
     * Get daily sales breakdown for a specific week
     */
    private function getDailySalesForWeek($startDate, $endDate)
    {
        $dailyData = Order::selectRaw('DATE(created_at) as date, COUNT(*) as orders, SUM(total) as sales')
            ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()])
            ->groupBy('date')
            ->orderBy('date')
            ->get();
            
        $dates = [];
        $salesByDate = [];
        $ordersByDate = [];
        
        // Generate all dates in the range
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $dates[] = $currentDate->format('D');
            $salesByDate[$dateStr] = 0;
            $ordersByDate[$dateStr] = 0;
            $currentDate->addDay();
        }
        
        // Fill in actual data
        foreach ($dailyData as $data) {
            $salesByDate[$data->date] = $data->sales;
            $ordersByDate[$data->date] = $data->orders;
        }
        
        return [
            'days' => $dates,
            'sales' => array_values($salesByDate),
            'orders' => array_values($ordersByDate)
        ];
    }
    
    /**
     * Get weekly sales breakdown for a specific month
     */
    private function getWeeklySalesForMonth($startDate, $endDate)
    {
        $weeklyData = [];
        
        $currentDate = clone $startDate;
        $weekNumber = 1;
        
        while ($currentDate <= $endDate) {
            $weekStartDate = clone $currentDate;
            $weekEndDate = (clone $currentDate)->addDays(6);
            
            // Adjust the last week to not exceed month end
            if ($weekEndDate > $endDate) {
                $weekEndDate = clone $endDate;
            }
            
            $orders = Order::whereBetween('created_at', [$weekStartDate->startOfDay(), $weekEndDate->endOfDay()])->get();
            
            $weeklyData[] = [
                'week' => 'Week ' . $weekNumber,
                'start_date' => $weekStartDate->format('M d'),
                'end_date' => $weekEndDate->format('M d'),
                'sales' => $orders->sum('total'),
                'orders' => $orders->count()
            ];
            
            $currentDate = (clone $weekEndDate)->addDay();
            $weekNumber++;
            
            // Break if we've gone past the end date
            if ($currentDate > $endDate) {
                break;
            }
        }
        
        return $weeklyData;
    }
    
    /**
     * Get sales by juice size for a date range
     */
    private function getSalesBySize($startDate, $endDate = null)
    {
        if (!$endDate) {
            $endDate = $startDate;
        }
        
        $sizeData = OrderItem::selectRaw('size, SUM(quantity) as quantity, SUM(total) as total')
            ->whereIn('order_id', function($query) use ($startDate, $endDate) {
                $query->select('id')
                    ->from('orders')
                    ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
            })
            ->groupBy('size')
            ->get();
        
        $sizes = ['small', 'medium', 'large'];
        $quantityBySize = [];
        $salesBySize = [];
        
        foreach ($sizes as $size) {
            $quantityBySize[$size] = 0;
            $salesBySize[$size] = 0;
        }
        
        foreach ($sizeData as $data) {
            $quantityBySize[$data->size] = $data->quantity;
            $salesBySize[$data->size] = $data->total;
        }
        
        return [
            'labels' => array_map('ucfirst', $sizes),
            'quantities' => array_values($quantityBySize),
            'sales' => array_values($salesBySize)
        ];
    }
    
    /**
     * Get popular juices for a date range
     */
    private function getPopularJuices($startDate, $endDate = null)
    {
        if (!$endDate) {
            $endDate = $startDate;
        }
        
        return OrderItem::selectRaw('juice_id, juice_name, SUM(quantity) as quantity, SUM(total) as total')
            ->whereIn('order_id', function($query) use ($startDate, $endDate) {
                $query->select('id')
                    ->from('orders')
                    ->whereBetween('created_at', [$startDate->startOfDay(), $endDate->endOfDay()]);
            })
            ->groupBy('juice_id', 'juice_name')
            ->orderByDesc('quantity')
            ->limit(10)
            ->get();
    }
    
    /**
     * Get top selling juices overall
     */
    private function getTopSellingJuices()
    {
        return OrderItem::selectRaw('juice_id, juice_name, SUM(quantity) as quantity, SUM(total) as total')
            ->groupBy('juice_id', 'juice_name')
            ->orderByDesc('quantity')
            ->limit(10)
            ->get();
    }
    
    /**
     * Get sales trend for the last 30 days
     */
    private function getSalesTrend()
    {
        $startDate = Carbon::now()->subDays(29)->startOfDay();
        $endDate = Carbon::now()->endOfDay();
        
        $dailyData = Order::selectRaw('DATE(created_at) as date, SUM(total) as sales')
            ->whereBetween('created_at', [$startDate, $endDate])
            ->groupBy('date')
            ->orderBy('date')
            ->get()
            ->keyBy('date');
            
        $trend = [];
        
        $currentDate = clone $startDate;
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $sales = isset($dailyData[$dateStr]) ? $dailyData[$dateStr]->sales : 0;
            
            $trend[] = [
                'date' => $currentDate->format('M d'),
                'sales' => $sales
            ];
            
            $currentDate->addDay();
        }
        
        return $trend;
    }
    
    /**
     * Download sales report as PDF
     */
    public function downloadReport(Request $request)
    {
        // Implementation for PDF download
        // This would typically use a package like dompdf or barryvdh/laravel-dompdf
        // For now, we'll just return a message
        return back()->with('info', 'PDF download functionality will be implemented soon.');
    }
}