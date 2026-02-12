<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class TourController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tours = Tour::paginate(25);
        return view('pages.tours.index', compact('tours'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $bookings = collect();
        return view('pages.tours.detail', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'status' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'price' => 'required|numeric',
                'description' => 'nullable'
            ]);

            Tour::create([
                'name' => $request->name,
                'status' => $request->status,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'price' => $request->price,
                'description' => $request->description,

            ]);
            return redirect()
                ->route('tours.index')
                ->with('success', 'Tour created successfully.');
        }  catch (ValidationException $e) {
            throw $e; // let Laravel handle validation
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Tour $tour)
    {
        $bookings = Booking::select('id','customer_name','customer_email','people_count','total_price')
                    ->where('tour_id',$tour->id)
                    ->paginate(25);
        return view('pages.tours.detail', compact('tour','bookings'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'name' => 'required',
                'status' => 'required',
                'start_date' => 'required|date',
                'end_date' => 'required|date|after_or_equal:start_date',
                'price' => 'required|numeric',
                'description' => 'nullable'
            ]);

            Tour::where('id', $id)->update([
                'name' => $request->name,
                'price' => $request->price,
                'start_date' => $request->start_date,
                'end_date' => $request->end_date,
                'status' => $request->status,
                'description' => $request->description,
            ]);

            return redirect()
                ->route('tours.index')
                ->with('success', 'Tour updated successfully.');
            } 
            catch (ValidationException $e) {
                throw $e; // let Laravel handle validation
            }
            
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
 
        $tour->delete();

        return redirect('tours')->with('success', 'Tour was deleted successfully.');
    }
}
