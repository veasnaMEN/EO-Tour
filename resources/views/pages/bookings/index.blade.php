@extends('layouts.app')
@section('title')<span>Booking</span>@endsection
@section('headerActions')
<a class="btn btn-primary" role="button" href="{{ route('bookings.create') }}">New Booking</a>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Customer Name</th>
      <th scope="col">Tour Name</th>
      <th scope="col">Customer Email</th>
      <th scope="col" class="text-center">People</th>
      <th scope="col" class="text-end">Total Price</th>
    </tr>
  </thead>
  <tbody>
    @forelse($bookings as $booking)
        <tr>
            <td>{{ $loop->iteration + ($bookings->currentPage() - 1) * $bookings->perPage() }}</td>
            <td>
                <a href="{{ route('bookings.show', $booking->id) }}" class="text-blue-500 hover:underline">
                    {{ $booking->customer_name }}
                </a>
            </td>
            <td>
                <a href="{{ route('tours.show', $booking->tour->id) }}" class="text-blue-500 hover:underline">
                {{ $booking->tour->name }}
                </a>
            </td>
            <td>{{$booking->customer_email}}</td>
            <td class="text-center">{{$booking->people_count}}</td>
            <td class="text-end">${{ number_format($booking->total_price, 2) }}</td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="p-2 border text-center text-gray-500">Not found</td>
        </tr>
    @endforelse
  </tbody>
</table>
<div class="mt-4">
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item {{ $bookings->onFirstPage() ? 'disabled' : '' }}">
                <a class="page-link" href="{{ $bookings->previousPageUrl() }}" tabindex="-1">Previous</a>
            </li>
            @foreach($bookings->getUrlRange(1, $bookings->lastPage()) as $page => $url)
                <li class="page-item {{ $bookings->currentPage() == $page ? 'active' : '' }}">
                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                </li>
            @endforeach
            <li class="page-item {{ $bookings->hasMorePages() ? '' : 'disabled' }}">
                <a class="page-link" href="{{ $bookings->nextPageUrl() }}">Next</a>
            </li>

        </ul>
    </nav>
</div>
@endsection