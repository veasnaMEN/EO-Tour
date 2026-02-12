@extends('layouts.app')
@section('title')<span>Tours</span>@endsection
@section('headerActions')
<a class="btn btn-primary" role="button" href="{{ route('tours.create') }}">New Tour</a>
@endsection
@section('content')
<table class="table table-striped table-bordered table-hover">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Name</th>
      <th scope="col">Start Date</th>
      <th scope="col">End Date</th>
      <th scope="col" class="text-end">Price</th>
      <th scope="col" class="text-center">Status</th>
    </tr>
  </thead>
  <tbody>
    @forelse($tours as $tour)
        <tr>
        <td>{{ $loop->iteration + ($tours->currentPage() - 1) * $tours->perPage() }}</td>
        <td>
            <a href="{{ route('tours.show', $tour->id) }}" class="text-blue-500 hover:underline">
                {{ $tour->name }}
            </a>
        </td>
        <td>{{$tour->start_date}}</td>
        <td>{{$tour->end_date}}</td>
        <td class="text-end">${{ number_format($tour->price, 2) }}</td>
        <td class="text-center">
            @if ($tour->status == 'active')
            <span class="badge rounded-pill text-bg-success">{{$tour->status}}</span>
            @else
            <span class="badge rounded-pill text-bg-secondary">{{$tour->status}}</span>
            @endif
        </td>
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

        {{-- Previous Page Link --}}
        <li class="page-item {{ $tours->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link" href="{{ $tours->previousPageUrl() }}" tabindex="-1">Previous</a>
        </li>

        {{-- Page Number Links --}}
        @foreach($tours->getUrlRange(1, $tours->lastPage()) as $page => $url)
            <li class="page-item {{ $tours->currentPage() == $page ? 'active' : '' }}">
                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
            </li>
        @endforeach

        {{-- Next Page Link --}}
        <li class="page-item {{ $tours->hasMorePages() ? '' : 'disabled' }}">
            <a class="page-link" href="{{ $tours->nextPageUrl() }}">Next</a>
        </li>

    </ul>
</nav>
</div>
@endsection