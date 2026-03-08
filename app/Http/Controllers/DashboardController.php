<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class DashboardController extends Controller
{

    public function client()
    {

        $userId = auth()->id();

        $totalOrders = Order::where('user_id',$userId)->count();

        $pendingOrders = Order::where('user_id',$userId)
            ->where('status','pending')
            ->count();

        $approvedOrders = Order::where('user_id',$userId)
            ->where('status','approved')
            ->count();

        $recentOrders = Order::where('user_id',$userId)
            ->latest()
            ->take(5)
            ->get();

        return view('client.dashboard',[
            'totalOrders'=>$totalOrders,
            'pendingOrders'=>$pendingOrders,
            'approvedOrders'=>$approvedOrders,
            'recentOrders'=>$recentOrders
        ]);

    }

    public function admin()
    {

    $ordersOverTime = Order::selectRaw('DATE(event_date) as date, COUNT(*) as total')
        ->groupBy('date')
        ->get();

    $ordersChartLabels = $ordersOverTime->pluck('date');
    $ordersChartData = $ordersOverTime->pluck('total');


    $statusStats = Order::selectRaw('status, COUNT(*) as total')
        ->groupBy('status')
        ->get();

    $statusLabels = $statusStats->pluck('status');
    $statusData = $statusStats->pluck('total');


    $popularItems = OrderItem::selectRaw('item_id, COUNT(*) as total')
        ->groupBy('item_id')
        ->orderByDesc('total')
        ->take(5)
        ->get();

    $itemLabels = $popularItems->map(fn($i)=>$i->item->name);
    $itemData = $popularItems->pluck('total');


    $topClients = Order::selectRaw('user_id, COUNT(*) as total')
        ->groupBy('user_id')
        ->orderByDesc('total')
        ->with('user')
        ->take(5)
        ->get();


    $upcomingEvents = Order::with('user')
        ->whereDate('event_date','>=',now())
        ->orderBy('event_date')
        ->take(5)
        ->get();


    $pastEvents = Order::with('user')
        ->whereDate('event_date','<',now())
        ->orderByDesc('event_date')
        ->take(5)
        ->get();


    return view('admin.dashboard',compact(
    'ordersChartLabels',
    'ordersChartData',
    'statusLabels',
    'statusData',
    'itemLabels',
    'itemData',
    'topClients',
    'upcomingEvents',
    'pastEvents'
    ));

    }

    public function analytics()
    {

        $ordersOverTime = Order::selectRaw('DATE(event_date) as date, COUNT(*) as total')
            ->groupBy('date')
            ->get();

        $ordersChartLabels = $ordersOverTime->pluck('date');
        $ordersChartData = $ordersOverTime->pluck('total');


        $statusStats = Order::selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->get();

        $statusLabels = $statusStats->pluck('status');
        $statusData = $statusStats->pluck('total');


        $popularItems = OrderItem::with('item')
            ->selectRaw('item_id, COUNT(*) as total')
            ->groupBy('item_id')
            ->orderByDesc('total')
            ->take(5)
            ->get();

        $itemLabels = $popularItems->map(fn($i)=>$i->item->name);
        $itemData = $popularItems->pluck('total');


        $topClients = Order::selectRaw('user_id, COUNT(*) as total')
            ->groupBy('user_id')
            ->orderByDesc('total')
            ->with('user')
            ->take(5)
            ->get();


        return view('admin.analytics',compact(
            'ordersChartLabels',
            'ordersChartData',
            'statusLabels',
            'statusData',
            'itemLabels',
            'itemData',
            'topClients'
        ));

    }

}