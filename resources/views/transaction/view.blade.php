@extends('layouts.app')

@section('content')
<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Visualizar Transações</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Visualizar Transações</li>
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
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Transações</h3>
                            <div class="card-tools">
                                <a href="{{ url('admin/transaction/register') }}" class="btn btn-sm btn-primary">Adicionar Nova Transação</a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Usuário</th>
                                            <th>Produto</th>
                                            <th>Quantidade</th>
                                            <th>Status do Pagamento</th>
                                            <th>Descrição</th>
                                            <th>Data de Criação</th>
                                            <th>Data de Atualização</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactions as $transaction)
                                            <tr>
                                                <td>{{ $transaction->id }}</td>
                                                <td>{{ $transaction->user->name }}</td>
                                                <td>{{ $transaction->product ? $transaction->product->name_product : 'Produto não encontrado' }}</td>
                                                <td>{{ $transaction->quantity }}</td>
                                                <td>
                                                
                                                <form method="POST" action="{{ route('admin.transaction.update_status') }}">
                                                    @csrf
                                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}">
                                                    <select name="status_id" class="form-control" style="width: 170px;" onchange="this.form.submit()">
                                                        <option value="0" {{ $transaction->payment_type == 0 ? 'selected' : '' }}>Pendente</option>
                                                        <option value="1" {{ $transaction->payment_type == 1 ? 'selected' : '' }}>Concluído</option>
                                                    </select>
                                                </form>
                                                </td>
                                                <td>{{ $transaction->description }}</td>
                                                <td>{{ date('d-m-Y H:i', strtotime($transaction->created_at)) }}</td>
                                                <td>{{ date('d-m-Y H:i', strtotime($transaction->updated_at)) }}</td>
                                                <td>
                                                    <div class="d-flex gap-1">
                                                        <a href="{{ url('admin/transaction/edit/' . $transaction->id) }}" class="btn btn-sm btn-warning">Editar</a>
                                                        <a href="{{ url('admin/transaction/delete/' . $transaction->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="9">Nenhuma transação encontrada</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@push('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>

</script>
@endpush
@endsection