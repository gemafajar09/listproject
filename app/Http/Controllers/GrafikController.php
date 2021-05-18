<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class GrafikController extends Controller
{
    public function index()
    {
        $months = [];
        for ($i=1; $i <= 12 ; $i++) { 
            $month = DB::table('tb_project')
                    ->whereMonth('tanggal_masuk', $i)
                    ->where('status', 0)
                    ->get();
                $months [] = count($month);
        }

        $months1 = [];
        for ($i=1; $i <= 12 ; $i++) { 
            $month = DB::table('tb_project')
                    ->whereMonth('tanggal_masuk', $i)
                    ->where('status', 1)
                    ->get();
                $months1 [] = count($month);
        }

        $months2 = [];
        for ($i=1; $i <= 12 ; $i++) { 
            $month = DB::table('tb_project')
                    ->whereMonth('tanggal_masuk', $i)
                    ->where('status', 2)
                    ->get();
                $months2 [] = count($month);
        }
        
        
        return view('grafik.index', 
            [
                'month' => json_encode($months),
                'month1' => json_encode($months1),
                'month2' => json_encode($months2)
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    public function month()
    {
        $months = [];
        for ($i=1; $i <= 12 ; $i++) { 
            $month = DB::table('tb_project')
                    ->whereMonth('tanggal_masuk', $i)
                    ->get();
                $months [] = $month;
        }
        
        return response()->json([
            'months' => $months
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
