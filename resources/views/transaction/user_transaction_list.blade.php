@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início::Cabeçalho de Conteúdo do App -->
    <div class="app-content-header">
        <!-- Início::Container -->
        <div class="container-fluid">
            <!-- Início::Linha -->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Transações</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Transações</li>
                    </ol>
                </div>
            </div>
            <!-- Fim::Linha -->
        </div>
        <!-- Fim::Container -->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesquisar Transação</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" id="id" placeholder="Digite o ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="amount">Valor</label>
                                            <input type="number" step="any" value="{{Request()->amount}}" name="amount" id="amount" placeholder="Digite o valor" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado Em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="updated_at">Atualizado Em</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                 <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="description">Descrição</label>
                                            <input type="text" value="{{Request()->description}}" name="description" id="description" placeholder="Digite a descrição" class="form-control">
                                        </div>
                                    </div>
                                 </div>
                                <div class="col-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                    <a href="{{url('user/transaction_list')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                <br>

                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">Lista de Transações</h3>
                        <div class="card-tools">
                            <ul class="pagination pagination-sm float-end">
                                <a href="{{ url('user/transaction_list/add') }}" class="btn btn-sm btn-primary">Adicionar Transação</a>
                            </ul>
                        </div>
                    </div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Valor</th>
                                    <th>Tipo de Pagamento</th>
                                    <th>Criado Em</th>
                                    <th>Atualizado Em</th>
                                    <th>Descrição</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->amount}}</td>
                                        <td>
                                            @if($value->payment_type == 1)
                                                Concluído
                                            @else
                                                Pendente
                                            @endif
                                        </td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->created_at)) }}</td>
                                        <td>{{ date('d-m-Y H:i A', strtotime($value->updated_at)) }}</td>
                                        <td>{{$value->description}}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="100%">Nenhum registro encontrado</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <div style="padding: 10px; float: right;">
                            <!-- Paginação ou outros controles podem vir aqui -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
