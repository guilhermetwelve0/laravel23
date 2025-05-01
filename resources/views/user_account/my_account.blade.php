@extends('layouts.app')

@section('content')

<main class="app-main">
    <div class="app-content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h3 class="mb-0">Minha Conta</h3>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-end">
                        <li class="breadcrumb-item"><a href="#">Início</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Atualizar Minha Conta</li>
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
                            <div class="card-title">Atualizar Minha Conta</div>
                        </div>
                        <form method="post" action="{{url('user/my_account_update')}}" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="card-body">
                                <!-- Nome -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="Digite o nome" value="{{$getRecord->name}}" required>
                                        <span style="color: red;">{{$errors->first('name')}}</span>
                                    </div>
                                </div>

                                <!-- E-mail -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">E-mail</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" name="email"
                                            placeholder="Digite o e-mail" value="{{$getRecord->email}}" required>
                                        <span style="color: red;">{{$errors->first('email')}}</span>
                                    </div>
                                </div>

                                <!-- Imagem de Perfil -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Imagem de Perfil</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="profile_image">
                                        @if(!empty($getRecord->profile_image) && file_exists('upload/'.$getRecord->profile_image))
                                            <img src="{{url('upload/'.$getRecord->profile_image)}}" style="height: 100px; width: 100px;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Nome do Website -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Nome do Website</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="website_name"
                                            placeholder="Digite o nome do site" value="{{$getWebsite->website_name ?? ''}}">
                                    </div>
                                </div>

                                <!-- Logo -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Logo</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="logo">
                                        @if(!empty($getWebsite->logo) && file_exists('upload/'.$getWebsite->logo))
                                            <img src="{{url('upload/'.$getWebsite->logo)}}" style="height: 100px;">
                                        @endif
                                    </div>
                                </div>

                                <!-- Favicon -->
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">Favicon</label>
                                    <div class="col-sm-10">
                                        <input type="file" class="form-control" name="favicon">
                                        @if(!empty($getWebsite->favicon) && file_exists('upload/'.$getWebsite->favicon))
                                            <img src="{{url('upload/'.$getWebsite->favicon)}}" style="height: 50px;">
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- Botão -->
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
