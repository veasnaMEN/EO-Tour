<!DOCTYPE html>
<html>

<head>
    <title>Bootstrap Laravel</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
@if ($errors->any())
<div style="color:red;">
    {{ $errors->first() }}
</div>
@endif
<div class="p-5 mx-auto" style="max-width: 450px">
    <div class="text-center">
        <h3>Log In</h3>
    </div>
    <form method="POST" action="/login">
    @csrf
    <!-- Email input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="email">Email</label>
    <input type="email" id="email" class="form-control" name="email" required/>
  </div>

  <!-- Password input -->
  <div data-mdb-input-init class="form-outline mb-4">
    <label class="form-label" for="form2Example2">Password</label>
    <input type="password" id="form2Example2" class="form-control" name="password" required/>
  </div>
  <!-- Submit button -->
  <button  type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-block mb-4 w-full">Login</button>
</form>
</div>
</body>
</html>