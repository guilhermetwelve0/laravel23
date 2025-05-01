@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-6">
                    <h3 class="mb-0">Fornecedor</h3>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Fornecedor</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="app-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Buscar Fornecedor</h3>
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
                                            <label for="supplier_name">Nome do Fornecedor</label>
                                            <input type="text" value="{{Request()->supplier_name}}" name="supplier_name" id="supplier_name" placeholder="Digite o nome do fornecedor" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="supplier_telephone">Telefone do Fornecedor</label>
                                            <input type="text" value="{{Request()->supplier_telephone}}" name="supplier_telephone" id="supplier_telephone" placeholder="Digite o telefone do fornecedor" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="supplier_address">Endereço do Fornecedor</label>
                                            <input type="text" value="{{Request()->supplier_address}}" name="supplier_address" id="supplier_address" placeholder="Digite o endereço do fornecedor" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="created_at">Criado em</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="form-group">
                                            <label for="updated_at">Atualizado em</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Buscar</button>
                                    <a href="{{url('admin/supplier')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                @include('_message')
                <div class="col-12">
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Fornecedores</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <a href="{{url('admin/supplier/supplier_pdf')}}" class="btn btn-sm btn-success">PDF de Fornecedores</a> &nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('admin/supplier/add') }}" class="btn btn-sm btn-primary">Adicionar Novo Fornecedor</a>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome do Fornecedor</th>
                                        <th>Telefone</th>
                                        <th>Endereço</th>
                                        <th>Criado em</th>
                                        <th>Atualizado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->supplier_name}}</td>
                                        <td>{{$value->supplier_telephone}}</td>
                                        <td>{{$value->supplier_address}}</td>
                                        <td>{{date('d-m-Y',strtotime($value->created_at))}}</td>
                                        <td>{{date('d-m-Y',strtotime($value->updated_at))}}</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ url('admin/supplier/supplier_pdf_row/' . $value->id) }}" class="btn btn-sm btn-success">PDF</a>
                                                <a href="{{ url('admin/supplier/edit/' . $value->id) }}" class="btn btn-sm btn-primary">Editar</a>
                                                <a href="{{ url('admin/supplier/delete/' . $value->id) }}" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                            </div>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7">Nenhum registro encontrado</td>
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
