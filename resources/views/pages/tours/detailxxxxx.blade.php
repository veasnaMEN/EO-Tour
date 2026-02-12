@extends('layouts.app')
@section('title')<span>{{$tour->name}}</span>@endsection
@section('headerActions')
    <!-- Button trigger modal -->
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
        Are you sure to delete this tour?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <form action="{{ route('tour.destroy', $tour->id) }}" method="POST">
    @csrf
    @method('DELETE')
            <button type="submit" class="btn btn-primary">Confirm</button>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
@section('content')
<p>Start Date: {{$tour->start_date}}</p>
<p>End Date: {{$tour->end_date}}</p>
<p>Price: ${{ number_format($tour->price, 1) }}</p>
<p>Description</p>
<p>{{$tour->description}}</p>

@endsection