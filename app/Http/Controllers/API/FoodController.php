<?php

namespace App\Http\Controllers\API;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id = $request->input('id');
        $limit = $request->input('limit', 6);
        $name = $request->input('name');
        $types = $request->input('types');

        $price_from = $request->input('price_form');
        $price_to = $request->input('price_to');

        $rate_from = $request->input('rate_from');
        $rate_to = $request->input('rate_to');

        if($id){
            $food = Food::find($id);

            if($food){
                return ResponseFormatter::success($food, 'Data produk berhasil diambil');
            }else{
                return ResponseFormatter::error(null, 'Data produk tidak ditemukan', 404);
            }
        }

        /** @var TYPE_NAME $food */
        $food = Food::query();

        if($name){
            $food->where('name', 'like', '%'.$name.'%');
        }
        if($types){
            $food->where('types', 'like', '%'.$types.'%');
        }
        if($price_from){
            $food->where('price', '>=', $price_from);
        }
        if($price_to){
            $food->where('price', '<=', $price_to);
        }
        if($rate_from){
            $food->where('rate', '>=', $rate_from);
        }
        if($rate_to){
            $food->where('rate', '<=', $rate_to);
        }

        return ResponseFormatter::success($food->paginate($limit), 'Data list produk berhasil diambil');
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Food $food)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Food  $food
     * @return \Illuminate\Http\Response
     */
    public function destroy(Food $food)
    {
        //
    }
}
