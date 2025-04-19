<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\PeminjamanModel;
use App\Models\PerbaikanModel;
use App\Models\tiketingModel;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPermintaan = tiketingModel::count();
        $totalPeminjaman = PeminjamanModel::count();
        $totalPerbaikan  = PerbaikanModel::count();
        $totalBarang     = BarangModel::count();
    
        return view('admin.dashboard', compact(
            'totalPermintaan',
            'totalPeminjaman',
            'totalPerbaikan',
            'totalBarang'
        ));
    }
    public function svp()
    {
        $totalPeminjaman = PeminjamanModel::count();
     
        return view('svp.dashboard', compact(
            
            'totalPeminjaman',
           
          
        ));
    }
}
