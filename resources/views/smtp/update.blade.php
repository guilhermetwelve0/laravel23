@extends('layouts.app')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">SMTP</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Atualizar SMTP</li>
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
                            <div class="card-title">Atualizar SMTP</div>
                        </div>
                        <form method="post" action="{{url('admin/smtp/update')}}">
                            {{csrf_field()}}
                            <div class="card-body">
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome do Aplicativo<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="app_name" placeholder="Digite o nome do aplicativo" value="{{$getRecord->app_name}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Mailer do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_mailer" placeholder="Digite o Mailer" value="{{$getRecord->mail_mailer}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Host do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_host" placeholder="Digite o Host" value="{{$getRecord->mail_host}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Porta do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_port" placeholder="Digite a Porta" value="{{$getRecord->mail_port}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Usuário do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_username" placeholder="Digite o Usuário" value="{{$getRecord->mail_username}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Senha do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_password" placeholder="Digite a Senha" value="{{$getRecord->mail_password}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Criptografia do E-mail<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_encryption" placeholder="Digite o Tipo de Criptografia" value="{{$getRecord->mail_encryption}}" required>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Endereço do Remetente<span style="color: red;">*</span></label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="mail_from_address" placeholder="Digite o Endereço do Remetente" value="{{$getRecord->mail_from_address}}" required>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Atualizar</button>
                                <a href="{{url('admin/smtp')}}" class="btn btn-success float-end">Redefinir</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
$(document).ready(function() {
    $('#memberSelect').select2({
        placeholder: "Digite para buscar ou selecione",
        allowClear: true,
        width: '100%',
    });
});
</script>

@endsection
