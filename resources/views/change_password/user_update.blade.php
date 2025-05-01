@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Alterar Senha</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Atualizar Alteração de Senha</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="app-content">
        <div class="container-fluid">
            <div class="row g-4">
                <div class="col-md-12">
                    @include('_message')
                    <div class="card card-warning card-outline mb-4">
                        <div class="card-header">
                            <div class="card-title">Atualizar Alteração de Senha</div>
                        </div>
                        <form method="post" action="{{url('user/change_password_update')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Senha Antiga
                                    </label>
                                    <div class="col-sm-10"><input type="password" class="form-control" name="old_password"
                                    placeholder="Digite a Senha Antiga" required>
                                    <span style="color: red;">{{$errors->first('old_password')}}</span></div>
                                </div>
                            </div>
                            <hr>
                            <div class="card-body">
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Nova Senha
                                    </label>
                                    <div class="col-sm-10"><input type="password" class="form-control" name="new_password"
                                    placeholder="Digite a Nova Senha" required>
                                    <span style="color: red;">{{$errors->first('new_password')}}</span></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row mb-3"><label class="col-sm-2 col-form-label">Confirmar Senha
                                    </label>
                                    <div class="col-sm-10"><input type="password" class="form-control" name="confirm_password"
                                    placeholder="Digite a Senha de Confirmação" required>
                                    <span style="color: red;">{{$errors->first('confirm_password')}}</span></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

@endsection
