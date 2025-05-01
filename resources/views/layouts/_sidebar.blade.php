@php
    $Geticon = App\Models\LogoWebsiteModel::getSingleFirst();
@endphp

<aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
    <div class="sidebar-brand">
        <a href="" class="brand-link">
            @if(!empty($Geticon->logo))
                @if(file_exists(public_path('upload/logo/'.$Geticon->logo)))
                    <img src="{{ url('upload/logo/'.$Geticon->logo) }}" class="brand-image opacity-75 shadow" />
                @elseif(file_exists(public_path('upload/'.$Geticon->logo)))
                    <img src="{{ url('upload/'.$Geticon->logo) }}" class="brand-image opacity-75 shadow" />
                @else
                    <img src="{{ url('upload/logo/default.png') }}" class="brand-image opacity-75 shadow" />
                @endif
                <span class="brand-text fw-light">{{ $Geticon->website_name }}</span>
            @else
                <img src="{{ url('upload/logo/default.png') }}" class="brand-image opacity-75 shadow" />
                <span class="brand-text fw-light">Sistema Padrão</span>
            @endif
        </a>
    </div>
    <!--end::Sidebar Brand-->
    
    <!--begin::Sidebar Wrapper-->
    <div class="sidebar-wrapper">
        <nav class="mt-2">
            <!--begin::Sidebar Menu-->
            <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                <!-- Menu do Administrador -->
                @if (Auth::user()->is_role == 1)
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                        <i class="nav-icon fa fa-dashboard"></i>
                        <p>Painel</p>
                    </a>
                </li>
                
                <!-- Seção Master com Collapse -->
                <li class="nav-header text-white">MASTER</li>
                <li class="nav-item">
                    <a href="#submenuMaster" data-bs-toggle="collapse" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Menu Master</p>
                    </a>
                    <ul class="collapse nav flex-column ms-1" id="submenuMaster" data-bs-parent=".sidebar-menu">
                        <li class="w-100">
                            <a href="{{ url('admin/category') }}" class="nav-link @if(Request::segment(2) == 'category') active @endif">
                                <i class="fa fa-cube"></i>
                                <p>Categorias</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/product') }}" class="nav-link @if(Request::segment(2) == 'product') active @endif">
                                <i class="fa fa-cubes"></i>
                                <p>Produtos</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/member') }}" class="nav-link @if(Request::segment(2) == 'member') active @endif">
                                <i class="fa fa-id-card"></i>
                                <p>Membros</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/supplier') }}" class="nav-link @if(Request::segment(2) == 'supplier') active @endif">
                                <i class="fa fa-truck"></i>
                                <p>Fornecedores</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Seção de Transações com Collapse -->
                <li class="nav-header text-white">TRANSAÇÕES</li>
                <li class="nav-item">
                    <a href="#submenuTransaction" data-bs-toggle="collapse" class="nav-link">
                        <i class="nav-icon fa fa-exchange-alt"></i>
                        <p>Menu de Transações</p>
                    </a>
                    <ul class="collapse nav flex-column ms-1" id="submenuTransaction" data-bs-parent=".sidebar-menu">
                        <li class="w-100">
                            <a href="{{ url('admin/expense') }}" class="nav-link @if(Request::segment(2) == 'expense') active @endif">
                                <i class="fa fa-adjust"></i>
                                <p>Despesas</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/purchase') }}" class="nav-link @if(Request::segment(2) == 'purchase') active @endif">
                                <i class="fa fa-download"></i>
                                <p>Compras</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/sales') }}" class="nav-link @if(Request::segment(2) == 'sales') active @endif">
                                <i class="fa fa-dollar-sign"></i>
                                <p>Lista de Vendas</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/transaction') }}" class="nav-link @if(Request::segment(2) == 'transaction') active @endif">
                                <i class="fa fa-cart-plus"></i>
                                <p>Nova Transação</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/logo') }}" class="nav-link @if(Request::segment(2) == 'logo') active @endif">
                                <i class="fa fa-bullhorn"></i>
                                <p>Logo</p>
                            </a>
                        </li>
                        <li>
                            <a href="{{ url('admin/transaction/view') }}" class="nav-link @if(Request::segment(2) == 'transaction' && Request::segment(3) == 'view') active @endif">
                                <i class="fa fa-eye"></i>
                                <p>Visualizar Transações</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Seção de Relatórios com Collapse -->
                <li class="nav-header text-white">RELATÓRIOS</li>
                <li class="nav-item">
                    <a href="#submenuReport" data-bs-toggle="collapse" class="nav-link">
                        <i class="nav-icon fa fa-chart-bar"></i>
                        <p>Menu de Relatórios</p>
                    </a>
                    <ul class="collapse nav flex-column ms-1" id="submenuReport" data-bs-parent=".sidebar-menu">
                        <li class="w-100">
                            <a href="{{ url('admin/smtp') }}" class="nav-link @if(Request::segment(2) == 'smtp') active @endif">
                                <i class="fa fa-envelope"></i>
                                <p>SMTP</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Seção de Sistema com Collapse -->
                <li class="nav-header text-white">SISTEMA</li>
                <li class="nav-item">
                    <a href="#submenuSystem" data-bs-toggle="collapse" class="nav-link">
                        <i class="nav-icon fa fa-cogs"></i>
                        <p>Menu do Sistema</p>
                    </a>
                    <ul class="collapse nav flex-column ms-1" id="submenuSystem" data-bs-parent=".sidebar-menu">
                        @if(Auth::user()->id == 1)
                        <li class="w-100">
                            <a href="{{ url('admin/users') }}" class="nav-link @if(Request::segment(2) == 'users') active @endif">
                                <i class="fa fa-users"></i>
                                <p>Usuários</p>
                            </a>
                        </li>
                        <!-- Link para registrar novo usuário -->
                        <li class="w-100">
                            <a href="{{ url('admin/users/register') }}" class="nav-link @if(Request::segment(2) == 'users' && Request::segment(3) == 'register') active @endif">
                                <i class="fa fa-user-plus"></i>
                                <p>Registrar Usuário</p>
                            </a>
                        </li>
                        @endif
                        <li>
                            <a href="{{ url('admin/my_account') }}" class="nav-link @if(Request::segment(2) == 'my_account') active @endif">
                                <i class="fa fa-cogs"></i>
                                <p>Minha Conta</p>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <!-- Menu do Usuário -->
                @elseif(Auth::user()->is_role == 2)
                <div class="sidebar-wrapper">
                    <nav class="mt-2">
                        <!--begin::Sidebar Menu-->
                        <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                            
                            <!-- Seção do Painel -->
                            <li class="nav-item">
                                <a href="{{ url('user/dashboard') }}" class="nav-link @if(Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fa fa-dashboard"></i>
                                    <p>Painel</p>
                                </a>
                            </li>
    
                            <!-- Seção de Transações com Collapse -->
                            <li class="nav-header text-white">TRANSAÇÕES</li>
                            <li class="nav-item">
                                <a href="#submenuTransaction" data-bs-toggle="collapse" class="nav-link">
                                    <i class="nav-icon fa fa-exchange-alt"></i>
                                    <p>Menu de Transações</p>
                                </a>
                                <ul class="collapse nav flex-column ms-1" id="submenuTransaction" data-bs-parent=".sidebar-menu">
                                    <li class="w-100">
                                        <a href="{{ url('user/new_transaction') }}" class="nav-link @if(Request::segment(2) == 'new_transaction') active @endif">
                                            <i class="fa fa-cart-plus"></i>
                                            <p>Nova Transação</p>
                                        </a>
                                    </li>
                                    <li class="w-100">
                                        <a href="{{ url('user/transaction_list') }}" class="nav-link @if(Request::segment(2) == 'transaction_list') active @endif">
                                            <i class="fa fa-dollar"></i>
                                            <p>Lista de Transações</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/my_account') }}" class="nav-link @if(Request::segment(2) == 'my_account') active @endif">
                                            <i class="fa fa-user"></i>
                                            <p>Minha Conta</p>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ url('user/change_password') }}" class="nav-link @if(Request::segment(2) == 'change_password') active @endif">
                                            <i class="fa fa-key"></i>
                                            <p>Alterar Senha</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <!--end::Sidebar Menu-->
                    </nav>
                </div>
                @endif
            </ul>
            <!--end::Sidebar Menu-->
        </nav>
    </div>
    <!--end::Sidebar Wrapper-->
</aside>