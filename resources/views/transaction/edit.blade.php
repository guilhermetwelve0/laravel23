@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Editar Transação</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Editar Transação</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    @include('_message')
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Editar Transação</h3>
                        </div>
                        
                        <form method="post" action="{{ route('admin.transaction.update', $transaction->id) }}">
                            @csrf
                            @method('PUT')
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Usuário</label>
                                    <div class="col-sm-10">
                                        <select name="user_id" class="form-control" required>
                                            <option value="">Selecione o Usuário</option>
                                            @foreach($users as $user)
                                                <option value="{{ $user->id }}" {{ $transaction->user_id == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Produto</label>
                                    <div class="col-sm-10">
                                        <select name="product_id" class="form-control" required>
                                            <option value="">Selecione o Produto</option>
                                            @foreach($products as $product)
                                                <option value="{{ $product->id }}" {{ $transaction->product_id == $product->id ? 'selected' : '' }}>
                                                    {{ $product->name_product }} - R$ {{ number_format($product->price, 2, ',', '.') }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Quantidade</label>
                                    <div class="col-sm-10">
                                        <input type="number" name="quantity" class="form-control" value="{{ $transaction->quantity }}" required>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Valor</label>
                                    <div class="col-sm-10">
                                        <input type="number" step="any" name="amount" class="form-control" value="{{ $transaction->amount }}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Tipo de Pagamento</label>
                                    <div class="col-sm-10">
                                        <select name="payment_type" class="form-control" required>
                                            <option value="">Selecione o tipo de pagamento</option>
                                            <option value="0" {{ $transaction->payment_type == 0 ? 'selected' : '' }}>Pendente</option>
                                            <option value="1" {{ $transaction->payment_type == 1 ? 'selected' : '' }}>Pago</option>
                                        </select>
                                    </div>
                                </div>


                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Descrição</label>
                                    <div class="col-sm-10">
                                        <textarea name="description" class="form-control" required>{{ $transaction->description }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="{{ url('admin/transaction/view') }}" class="btn btn-danger float-end">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
