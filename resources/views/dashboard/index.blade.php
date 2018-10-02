@extends('layouts.dashboard')

@section('content')
<div class="card mb4">
  <div class="card-header">
    Welcome Screen
  </div>

  <div class="card-body">
    Selamat Datang di {{ env('APP_NAME') }}
  </div>
</div>

<hr>

<div class="card mb4">
  <div class="card-header">
    Informasi Cepat
  </div>

  <div class="card-body">
    <table class="table">
      <tr>
        <td>Nama</td>
        <td>{{ auth()->user()->name }}</td>
      </tr>
      <tr>
        <td>Email</td>
        <td>{{ auth()->user()->email }}</td>
      </tr>
      <tr>
        <td>Role</td>
        <td>{{ auth()->user()->role }}</td>
      </tr>
    </table>
  </div>
</div>
@endsection
