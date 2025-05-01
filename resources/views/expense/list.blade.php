@extends('layouts.app')

@section('content')

<main class="app-main">
    <!--begin::App Content Header-->
    <div class="app-content-header">
        <!--begin::Container-->
        <div class="container-fluid">
            <!--begin::Row-->
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Despesas</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Despesas</li>
                    </ol>
                </div>
            </div>
            <!--end::Row-->
        </div>
        <!--end::Container-->
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Pesquisar Despesas</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" placeholder="Digite o ID" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="description">DESCRIÇÃO</label>
                                            <input type="text" value="{{Request()->description}}" name="description" id="description" placeholder="Digite a descrição" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="amount">Valor</label>
                                            <input type="number" step="any" name="amount" value="{{Request()->amount}}" placeholder="Digite o valor" id="amount" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Data de Criação</label>
                                            <input type="date" name="created_at" value="{{Request()->created_at}}" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated_at">Data de Atualização</label>
                                            <input type="date" name="updated_at" value="{{Request()->updated_at}}" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                    <a href="{{url('admin/expense')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>

                    <br>

                    @include('_message')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Despesas</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <a href="{{ url('admin/expense/add') }}" class="btn btn-sm btn-primary">Adicionar Despesa</a>
                                </ul>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Descrição</th>
                                            <th>Valor</th>
                                            <th>Data de Criação</th>
                                            <th>Data de Atualização</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $totalAmount = 0;
                                        @endphp
                                        @forelse($getRecord as $value)
                                            @php
                                                $totalAmount = $totalAmount + $value->amount;
                                            @endphp
                                            <tr>
                                                <td>{{$value->id}}</td>
                                                <td>{{$value->description}}</td>
                                                <td>{{number_format($value->amount, 2)}}</td>
                                                <td>{{date('d-m-Y', strtotime($value->created_at))}}</td>
                                                <td>{{date('d-m-Y', strtotime($value->updated_at))}}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <a href="{{ url('admin/expense/edit/' . $value->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                                        <a href="{{ url('admin/expense/delete/' . $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6">Nenhum registro encontrado</td>
                                            </tr>
                                        @endforelse
                                        @if(!empty($totalAmount))
                                            <tr>
                                                <th colspan="2">Valor Total</th>
                                                <td>{{number_format($totalAmount, 2)}}</td>
                                                <th colspan="3"></th>
                                            </tr>
                                        @endif
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
    </div>
</main>

@endsection