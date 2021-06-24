<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarImage;
use Illuminate\Http\Request;

class CarController extends Controller
{
    //
    public function Index(Request $request)
    {
        //$cars = Car::query()->get();
        //dd($cars);
        $cars = Car::latest()->paginate(5);

        return view('cars.index', compact('cars'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
    public function show(Car $car)
    {
        return view('cars.show', compact('car'));
    }
    public function create()
    {
        return view('cars.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required'
        ]);
        $car = new Car;
        $car->name=$request->name;
        $car->description=$request->description;
        $car->save();
        foreach((array)$request->car_images as $image){
            $car_image=new CarImage;
            $car_image->name=$image->store('images');
            $car_image->priority=1;
            $car_image->is_main=1;
            $car_image->id_car=$car->id;
            $car_image->save();
        }

        return redirect()->route('cars.index')
            ->with('success', 'Car created successfully.');
    }
}
