<?php
// DashboardController.php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Chef;
use App\Models\Dish;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (auth()->check() && auth()->user()->role !== 'admin') {
                return redirect('/'); 
            }
            return $next($request);
        });
    }

    public function index()
    {
        $usersCount = User::where('role', 'user')->count();
        $adminsCount = User::where('role', 'admin')->count();
        $chefsCount = Chef::count();
        $dishesCount = Dish::count();

        // Data for the pie chart
        $chartData = [
            'users' => $usersCount,
            'admins' => $adminsCount,
            'chefs' => $chefsCount,
        ];

        return view('dashboard.dashboard', compact('usersCount', 'adminsCount', 'chefsCount', 'dishesCount', 'chartData'));
    }
}
