@extends('layouts.app')

@section('content')

<main class="app-main">
    <!-- Início: Cabeçalho do Conteúdo do App -->
    <div class="app-content-header">
        <!-- Início: Container -->
        <div class="container-fluid">
            <!-- Início: Linha -->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Usuários</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Usuários</li>
                    </ol>
                </div>
            </div>
            <!-- Fim: Linha -->
        </div>
        <!-- Fim: Container -->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Usuários</h3>
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
                                            <label for="name">Nome</label>
                                            <input type="text" value="{{Request()->name}}" name="name" id="name" placeholder="Digite o Nome" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="email">E-mail</label>
                                            <input type="text" value="{{Request()->email}}" name="email" id="email" placeholder="Digite o E-mail" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="updated_at">Atualizado em</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="clear: both;"></div>
                                <div class="col-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                    <a href="{{url('admin/users')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    @include('_message')

                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Usuários</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <!-- Paginação -->
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>E-mail</th>
                                        <th>Carteiras</th>
                                        <th>Criado em</th>
                                        <th>Atualizado em</th>
                                        <th>Ação</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->name}}</td>
                                        <td>{{$value->email}}</td>
                                        <td>{{$value->wallets}}</td>
                                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                        <td>{{date('d-m-Y H:i A', strtotime($value->updated_at))}}</td>
                                        <td>
                                            <a href="{{url('admin/users/delete/'.$value->id)}}"
                                               onclick="return confirm('Tem certeza que deseja excluir?')"
                                               class="btn btn-sm btn-danger">Excluir</a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="100%">Nenhum registro encontrado</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div style="padding: 10px; float: right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
