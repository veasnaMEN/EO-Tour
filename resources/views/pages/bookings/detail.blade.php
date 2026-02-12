

@extends('layouts.app')
@section('title') {{ isset($tour) ? 'Edit Booking' : 'Add Booking' }}@endsection
@section('headerActions')
@isset($booking)
  <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
    Delete
  </button>
  <!-- Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Message</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure to delete this booking?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <form action="{{ route('bookings.destroy', $booking->id) }}" method="POST">
      @csrf
      @method('DELETE')
              <button type="submit" class="btn btn-primary">Confirm</button>
          </form>
        </div>
      </div>
    </div>
  </div>
@endisset

@endsection
@section('content')
<form action="{{ isset($booking) 
        ? route('bookings.update', $booking->id) 
        : route('bookings.store') }}" 
      method="POST">

    @csrf
    @isset($booking)
        @method('PUT')
    @endisset
<div class="mb-3 row">
  <label for="tourName" class="col-sm-2 col-form-label">Customer Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="CustomerName" name="customer_name" value="{{ old('customer_name', $booking->customer_name ?? '') }}" required>
  </div>
</div>

<div class="mb-3 row">
  <label for="tourName" class="col-sm-2 col-form-label">Customer Email</label>
  <div class="col-sm-10">
    <input type="email" class="form-control" id="CustomerEmail" name="customer_email" value="{{ old('customer_email', $booking->customer_email ?? '') }}">
  </div>
</div>

<div class="mb-3 row">
  <label for="price" class="col-sm-2 col-form-label">People</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="people_count" value="{{ old('people_count', $booking->people_count ?? 1) }}" name="people_count">
  </div>
</div>

<div class="mb-3 row">
  <label for="tour" class="col-sm-2 col-form-label">Tour</label>
  <div class="col-sm-10">
    <select name="tour_id" class="form-control @error('tour_id') is-invalid @enderror">
        <option value="">Select Tour</option>
        @foreach ($tours as $tour)
            <option value="{{ $booking->tour_id }}"
                {{ old('tour_id', $booking->tour_id ?? '') == $tour->id ? 'selected' : '' }}>
                {{ $tour->name }} | ${{ number_format($tour->price, 2) }}
            </option>
        @endforeach
    </select>
    @error('tour_id')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>
</div>
@isset($booking)
<div class="mb-3 row">
  <label for="tour" class="col-sm-2 col-form-label">Total Price: </label>
  <div class="col-sm-10 flex items-center">
    <div>${{ number_format($booking->total_price, 2) }}</div>
  </div>
</div>
@endisset

   @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
<div style="text-align: right">
    <button class="btn btn-primary">
        Save
    </button>
</div>
</form>

@endsection