@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Registrar Novo Usuário</h2>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
      <div class="alert alert-danger">
          <ul>
              @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
    @endif
    <form action="{{ route('admin.users.register') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" id="name" required>
        </div>
        
        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>
</div>
@endsection
