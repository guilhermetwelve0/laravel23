@component('mail::message')
Olá, {{ $user->name}}. Esqueceu sua senha?

<p>Acontece. Clique no botão abaixo para redefinir sua senha.</p>

@component('mail::button', ['url' => url('reset/'.$user->remember_token)])
Redefinir Senha
@endcomponent

! Caso tenha algum problema ao recuperar sua senha, por favor entre em contato conosco
através do formulário na página de contato.

Atenciosamente,<br>

{{ config('app.name') }}

@endcomponent