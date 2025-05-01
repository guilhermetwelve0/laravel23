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
                    <h3 class="mb-0">Membros</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Membros</li>
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
                            <h3 class="card-title">Pesquisar Membro</h3>
                        </div>
                        <form method="get">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="id">ID</label>
                                            <input type="text" name="id" value="{{Request()->id}}" id="id" placeholder="Digite o ID"
                                                class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="code_member">Código do Membro</label>
                                            <input type="text" value="{{Request()->code_member}}" name="code_member" id="code_member"
                                                placeholder="Digite o código" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="name_member">Nome do Membro</label>
                                            <input type="text" value="{{Request()->name_member}}" name="name_member" id="name_member"
                                                placeholder="Digite o nome" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Endereço</label>
                                            <input type="text" value="{{Request()->address}}" name="address" id="address" placeholder="Digite o endereço"
                                                class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="telefone">Telefone</label>
                                            <input type="number" value="{{Request()->telefone}}" name="telefone" id="telefone"
                                                placeholder="Digite o telefone" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="created_at">Data de Criação</label>
                                            <input type="date" value="{{Request()->created_at}}" name="created_at" id="created_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="updated_at">Data de Atualização</label>
                                            <input type="date" value="{{Request()->updated_at}}" name="updated_at" id="updated_at" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div style="clear:both;"></div>
                                <div class="col-md-12" style="margin-top: 15px;">
                                    <button class="btn btn-primary" type="submit">Pesquisar</button>
                                    <a href="{{url('admin/member')}}" class="btn btn-success">Limpar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                    <br>
                    @include('_message')
                    <div class="card mb-4">
                        <div class="card-header">
                            <h3 class="card-title">Lista de Membros</h3>
                            <div class="card-tools">
                                <ul class="pagination pagination-sm float-end">
                                    <a href="{{ url('admin/member/member_pdf') }}" class="btn btn-sm btn-success">
                                        PDF de Membros</a>
                                        &nbsp;&nbsp;&nbsp;
                                    <a href="{{ url('admin/member/add') }}" class="btn btn-sm btn-primary">Adicionar
                                        Membro</a>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Código</th>
                                        <th>Nome</th>
                                        <th>Endereço</th>
                                        <th>Telefone</th>
                                        <th>Criado em</th>
                                        <th>Atualizado em</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($getRecord as $value)
                                    <tr>
                                        <td>{{$value->id}}</td>
                                        <td>{{$value->code_member}}</td>
                                        <td>{{$value->name_member}}</td>
                                        <td>{{$value->address}}</td>
                                        <td>{{$value->telefone}}</td>
                                        <td>{{date('d-m-Y H:i A', strtotime($value->created_at))}}</td>
                                        <td>{{date('d-m-Y', strtotime($value->updated_at))}}</td>
                                        <td>
                                            <div class="d-flex">
                                            <a href="{{ route('member.pdf_row', ['id' => $value->id]) }}" class="btn btn-sm btn-primary">PDF</a>
                                                <a href="{{ url('admin/member/edit/' . $value->id) }}"
                                                    class="btn btn-sm btn-success">Editar</a>
                                                <a href="{{ url('admin/member/delete/' . $value->id) }}"
                                                    class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Tem certeza que deseja excluir?')">Excluir</a>
                                            </div>
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