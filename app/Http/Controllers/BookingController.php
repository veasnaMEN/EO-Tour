<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with('tour')
                        ->orderBy('created_at', 'desc')
                        ->paginate(25);
        return view('pages.bookings.index', compact('bookings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tours = Tour::select('id','name','start_date','end_date','price')
                    ->where('status','active')
                    ->get();
        return view('pages.bookings.detail', compact('tours'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'customer_name' => 'required',
                'people_count' => 'required|integer|min:1',
                'tour_id' => 'required|exists:tours,id',
            ]);

            // caculate total price
            $tour_price = Tour::where('id', $request->tour_id)->value('price');
            $total_price = $tour_price * $request->people_count;

            Booking::create([
                'tour_id' => $request->tour_id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'people_count' => $request->people_count,
                'total_price' => $total_price,
            ]);
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Booking created successfully.');
        }  catch (ValidationException $e) {
            throw $e; // let Laravel handle validation
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        $tours = Tour::select('id','name','start_date','end_date','price')
                    ->where('status','active')
                    ->get();
        return view('pages.bookings.detail', compact('booking','tours'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        
        try {
            $request->validate([
                'customer_name' => 'required',
                'people_count' => 'required|integer|min:1',
                'tour_id' => 'required|exists:tours,id',
            ]);

            // caculate total price
            $tour_price = Tour::where('id', $request->tour_id)->value('price');
            $total_price = $tour_price * $request->people_count;

            Booking::where('id', $id)->update([
                'tour_id' => $request->tour_id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'people_count' => $request->people_count,
                'total_price' => $total_price,
            ]);
            return redirect()
                ->route('bookings.index')
                ->with('success', 'Booking updated successfully.');
        }  catch (ValidationException $e) {
            throw $e; // let Laravel handle validation
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $booking = Booking::findOrFail($id);
 
        $booking->delete();

        return redirect('bookings')->with('success', 'Booking was deleted successfully.');
    }
}
