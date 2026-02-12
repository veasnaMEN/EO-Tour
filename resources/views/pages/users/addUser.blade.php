@extends('layouts.app')

@section('content')
@if ($errors->any())
<div style="color:red;">
    {{ $errors->first() }}
</div>
@endif
<div class="max-w-[335px] my-0 mx-auto">
    <div class="text-center">
        <h3>Create User</h3>
    </div>
    <form method="POST" action="/register">
    @csrf
    <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="name">Name</label>
    <input type="text" id="name" class="form-control" name="name" required/>
  </div>
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="email">Email</label>
    <input type="email" id="email" class="form-control" name="email" required/>
  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="password">Password</label>
    <input type="password" id="password" class="form-control" name="password" required/>
  </div>
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="confirmed">Confirm Password</label>
    <input type="password" id="confirmed" class="form-control" name="confirmed" required/>
  </div>
  <!-- Submit button -->
  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4 w-full">Login</button>
</form>
</div>
@endsection