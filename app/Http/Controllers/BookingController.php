<?php

namespace App\Http\Controllers;

use App\Http\Resources\BookingPanelResource;
use App\Mail\BookingNotif;
use App\Mail\BookingReceipt;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = User::where('id', Auth::user()->id)->with([
            'bookings' => function ($query) {
                $query->orderBy('created_at', 'desc');
            }
        ])->first()->bookings;
        return response()->json([
            'bookings' => BookingPanelResource::collection($bookings),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'fullname' => 'string|required',
            'email' => 'email|required',
            'contact' => 'string|required',
            'local_guests' => 'numeric|min:0',
            'foreign_guests' => 'numeric|min:0',
            'event_date' => 'date|required',
            'pick_up' => 'string|nullable',
            'special_requests' => 'string|nullable',
            'client' => 'string|required',
            'product' => 'required|exists:products,id',
        ]);

        $clientId = User::unfork($request->client ?? null);
        if(!$clientId || !($clientData = User::find($clientId))) {
            return response()->json('ID not found.', 422);
        }

        if($booking = Booking::create([
            'client_id' => $clientId,
            'product_id' => $request->product,
            'fullname' => $request->fullname,
            'email' => $request->email,
            'contact' => $request->contact,
            'local_guests' => $request->local_guests,
            'foreign_guests' => $request->foreign_guests,
            'event_date' => $request->event_date,
            'pick_up_info' => $request->pick_up,
            'special_requests' => $request->special_requests,
        ])) {
            Mail::to($booking->email)->send(new BookingReceipt($booking));
            Mail::to('almario.dev@gmail.com')->send(new BookingNotif($booking));
            Mail::to('jjamtravelandtours@gmail.com')->send(new BookingNotif($booking));
            return response()->json('Successfully booked.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
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
    public function update(Request $request, Booking $booking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        //
    }

    public function generateBookToken() {

    }
}
