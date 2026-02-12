

@extends('layouts.app')
@section('title') {{ isset($tour) ? 'Edit Tour' : 'Add Tour' }}@endsection
@section('headerActions')
@isset($tour)
  

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
        <form action="{{ route('tours.destroy', $tour->id) }}" method="POST">
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
<form action="{{ isset($tour) 
        ? route('tours.update', $tour->id) 
        : route('tours.store') }}" 
      method="POST">

    @csrf
    @isset($tour)
        @method('PUT')
    @endisset
<div class="mb-3 row">
  <label for="tourName" class="col-sm-2 col-form-label">Tour Name</label>
  <div class="col-sm-10">
    <input type="text" class="form-control" id="tourName" name="name" value="{{ old('name', $tour->name ?? '') }}" required>
  </div>
</div>

<div class="mb-3 row">
  <label for="startDate" class="col-sm-2 col-form-label">Start Date</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="startDate" name="start_date" value="{{ old('start_date', isset($tour) ? $tour->start_date : '') }}">
    @error('start_date')
      <div class="valid-message">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="mb-3 row">
  <label for="endDate" class="col-sm-2 col-form-label">End Date</label>
  <div class="col-sm-10">
    <input type="date" class="form-control" id="endDate" name="end_date" value="{{ old('end_date', isset($tour) ? $tour->end_date : '') }}">
    @error('end_date')
      <div class="valid-message">{{ $message }}</div>
    @enderror
  </div>
</div>

<div class="mb-3 row">
  <label for="price" class="col-sm-2 col-form-label">Price</label>
  <div class="col-sm-10">
    <input type="number" class="form-control" id="price" value="{{ old('price', $tour->price ?? 0) }}" name="price">
  </div>
</div>

<div class="mb-3 row">
  <label for="status" class="col-sm-2 col-form-label">Status</label>
  <div class="col-sm-10">
  <select name="status" class="form-control">
      <option value="">Select Status</option>
      <option value="active"
          {{ old('status', $tour->status ?? '') == 'active' ? 'selected' : '' }}>
          Active
      </option>

      <option value="inactive"
          {{ old('status', $tour->status ?? '') == 'inactive' ? 'selected' : '' }}>
          Inactive
      </option>
  </select>
  @error('status')
    <div class="valid-message">{{ $message }}</div>
  @enderror
  </div>
</div>

<div class="mb-3 row">
  <label for="description" class="col-sm-2 col-form-label">Description</label>
  <div class="col-sm-10">
    <textarea class="form-control" id="description" rows="3" name="description" value="{{ old('description', $tour->description ?? "") }}"></textarea>
  </div>
</div>
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