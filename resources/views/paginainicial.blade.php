<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SalesFlow</title>
  <style>
    * {
      margin: 0; padding: 0; box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(to bottom, #f9fafb, #fff);
      color: #1f2937;
      line-height: 1.6;
    }
    header {
      position: fixed;
      top: 0;
      width: 100%;
      background: white;
      box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      z-index: 1000;
    }
    .nav {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 0 auto;
      padding: 1rem;
    }
    .nav a {
      color: #4b5563;
      margin-left: 1.5rem;
      text-decoration: none;
    }
    .nav a:hover {
      color: #111827;
    }
    .brand {
      font-size: 1.5rem;
      font-weight: bold;
      display: flex;
      align-items: center;
      gap: 0.5rem;
      color: #111827;
    }
    main {
      padding-top: 5rem;
    }
    .btn-assinar {
  display: inline-block;
  margin-top: 1rem;
  padding: 0.75rem 2rem;
  background-color: #2563eb;
  color: white;
  font-weight: 600;
  border-radius: 9999px;
  text-decoration: none;
  box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
  transition: background 0.3s ease, transform 0.2s ease;
}
.btn-assinar:hover {
  background-color: #1d4ed8;
  transform: translateY(-2px);
}

    .section {
      padding: 4rem 1rem;
      max-width: 1200px;
      margin: auto;
    }
    .hero {
      display: flex;
      flex-wrap: wrap;
      align-items: center;
      gap: 2rem;
    }
    .hero-text {
      flex: 1;
    }
    .hero h1 {
      font-size: 2.5rem;
      font-weight: bold;
    }
    .hero p {
      margin-top: 1rem;
      color: #6b7280;
    }
    .hero-buttons a {
      display: inline-block;
      margin-top: 1.5rem;
      margin-right: 1rem;
      padding: 0.75rem 1.5rem;
      border-radius: 8px;
      font-weight: 600;
      text-decoration: none;
    }
    .btn-primary {
      background: #2563eb;
      color: white;
    }
    .btn-secondary {
      background: white;
      color: #1f2937;
      border: 1px solid #d1d5db;
    }
    .features, .stats, .testimonials {
      text-align: center;
    }
    .feature-grid, .testimonial-grid, .stat-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
      gap: 2rem;
      margin-top: 2rem;
    }
    .card {
      background: white;
      padding: 1.5rem;
      border-radius: 1rem;
      box-shadow: 0 2px 6px rgba(0,0,0,0.05);
      text-align: left;
    }
    .card h3 {
      margin-top: 1rem;
      font-size: 1.2rem;
      font-weight: 600;
    }
    .card p {
      color: #6b7280;
      margin-top: 0.5rem;
    }
    .icon {
      width: 32px;
      height: 32px;
      fill: #2563eb;
    }
    .cta {
      background: linear-gradient(to right, #2563eb, #1e40af);
      color: white;
      padding: 4rem 1rem;
    }
    .cta h2 {
      font-size: 2rem;
      font-weight: bold;
    }
    .form {
      margin-top: 2rem;
      display: grid;
      gap: 1rem;
    }
    .form input {
      padding: 0.75rem;
      border-radius: 6px;
      border: 1px solid #ccc;
    }
    .form button {
      padding: 0.75rem;
      border-radius: 6px;
      background: #2563eb;
      color: white;
      font-weight: bold;
      border: none;
    }
    footer {
      background: #f3f4f6;
      padding: 2rem 1rem;
      text-align: center;
      font-size: 0.875rem;
    }

    @media (max-width: 768px) {
      .hero {
        flex-direction: column;
        text-align: center;
      }
    }
  </style>
</head>
<body>

  <!-- Header -->
  <header>
    <div class="nav">
      <div class="brand">📊 SalesFlow</div>
      <div>
        <a href="#features">Recursos</a>
        <a href="#stats">Resultados</a>
        <a href="#testimonials">Depoimentos</a>
        <a href="#contact">Contato</a>
      </div>
    </div>
  </header>

  <main>
    <!-- Hero -->
    <section class="section hero">
      <div class="hero-text">
        <h1>Simplifique a gestão <br><span style="color:#2563eb">das suas vendas</span></h1>
        <p>Organize seus leads, acompanhe negociações e tome decisões mais assertivas com uma ferramenta simples e eficiente.</p>
        <div class="hero-buttons">
          <a href="#contact" class="btn-primary">Começar Teste Gratuito →</a>
          <a href="{{ route('login') }}" class="btn-secondary">Ver Demonstração</a>
        </div>
      </div>
      <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&q=80&w=800&h=600" width="100%" style="max-width:500px; border-radius: 1rem;" />
    </section>

    <!-- Stats -->
    <section id="stats" class="section stats">
      <h2>Resultados Reais</h2>
      <div class="stat-grid">
        <div>
          <div style="font-size:2rem; font-weight: bold;">50%</div>
          <p>Menos tempo em tarefas manuais</p>
        </div>
        <div>
          <div style="font-size:2rem; font-weight: bold;">30%</div>
          <p>Aumento na taxa de conversão</p>
        </div>
        <div>
          <div style="font-size:2rem; font-weight: bold;">95%</div>
          <p>Taxa de satisfação</p>
        </div>
      </div>
    </section>

    <!-- Features -->
    <section id="features" class="section features">
      <h2>Recursos Essenciais</h2>
      <p>Tudo que você precisa para gerenciar suas vendas em um só lugar</p>
      <div class="feature-grid">
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M5 3a2 2 0 00-2 2v1h18V5a2 2 0 00-2-2H5zm16 5H3v11a2 2 0 002 2h14a2 2 0 002-2V8zm-4 3v2h-2v-2h2z"/></svg>
          <h3>Pipeline Organizado</h3>
          <p>Visualize e gerencie todas as suas oportunidades de vendas em um único lugar.</p>
        </div>
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5s-3 1.34-3 3 1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5s-3 1.34-3 3 1.34 3 3 3zm0 2c-2.67 0-8 1.34-8 4v3h6v-3c0-1.33.67-2.67 2-3.34C9.33 13.67 10 15 10 16v3h6v-3c0-2.66-5.33-4-8-4z"/></svg>
          <h3>Gestão de Equipe</h3>
          <p>Acompanhe o desempenho da sua equipe e distribua leads de forma eficiente.</p>
        </div>
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 17h2v2H3zm4-4h2v6H7zm4-4h2v10h-2zm4-4h2v14h-2zm4 8h2v6h-2z"/></svg>
          <h3>Relatórios Práticos</h3>
          <p>Análise clara das suas vendas com gráficos e métricas importantes.</p>
        </div>
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M15 1H9v2h6V1zm1 3H8a1 1 0 00-1 1v3h10V5a1 1 0 00-1-1zm2 4H6a1 1 0 00-1 1v10a1 1 0 001 1h12a1 1 0 001-1V9a1 1 0 00-1-1z"/></svg>
          <h3>Lembretes Automáticos</h3>
          <p>Nunca perca um follow-up com lembretes automáticos de tarefas.</p>
        </div>
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17l-5-5h10l-5 5zm0-14C6.48 3 2 7.48 2 13c0 2.64 1.07 5.04 2.82 6.78A9.924 9.924 0 0012 23c5.52 0 10-4.48 10-10S17.52 3 12 3z"/></svg>
          <h3>Dados Seguros</h3>
          <p>Seus dados protegidos com criptografia e backup automático.</p>
        </div>
        <div class="card">
          <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M13 2h-2v10h2V2zm-6.95 5.05l-1.41 1.41L9.17 13H3v2h8.17l-4.53 4.54 1.41 1.41L15 13z"/></svg>
          <h3>Metas e Objetivos</h3>
          <p>Defina e acompanhe metas de vendas para sua equipe.</p>
        </div>
      </div>
    </section>
    
    <!-- Plans -->
<section id="plans" class="section plans">
  <h2 style="text-align:center">Planos para Todos os Negócios</h2>
  <p style="text-align:center">Escolha o plano que melhor se adapta à sua empresa</p>
  <div class="feature-grid">
    <div class="card">
      <h3>Básico</h3>
      <p style="font-size: 2rem; font-weight: bold;">R$49/mês</p>
      <ul style="margin-top: 1rem; padding-left: 1rem; color: #4b5563;">
        <li>✅ 1 usuário</li>
        <li>✅ Pipeline simples</li>
        <li>✅ Suporte por email</li>
      </ul>
      <a href="#contact" class="btn-assinar">Assinar agora</a>
    </div>
    <div class="card">
      <h3>Profissional</h3>
      <p style="font-size: 2rem; font-weight: bold;">R$99/mês</p>
      <ul style="margin-top: 1rem; padding-left: 1rem; color: #4b5563;">
        <li>✅ Até 5 usuários</li>
        <li>✅ Pipeline avançado</li>
        <li>✅ Relatórios e metas</li>
        <li>✅ Suporte por chat</li>
      </ul>
       <a href="#contact" class="btn-assinar">Assinar agora</a>
    </div>
    <div class="card">
      <h3>Empresarial</h3>
      <p style="font-size: 2rem; font-weight: bold;">R$199/mês</p>
      <ul style="margin-top: 1rem; padding-left: 1rem; color: #4b5563;">
        <li>✅ Usuários ilimitados</li>
        <li>✅ Dashboard completo</li>
        <li>✅ Suporte premium</li>
        <li>✅ Integrações e API</li>
      </ul>
      <a href="#contact" class="btn-assinar">Assinar agora</a>
</section>


    <!-- Testimonials -->
    <section id="testimonials" class="section testimonials">
      <h2>O que nossos clientes dizem</h2>
      <div class="testimonial-grid">
        <div class="card">
          <p>“O SalesFlow nos ajudou a organizar melhor nosso processo de vendas. A equipe está mais produtiva.”</p>
          <p><strong>Ana Silva</strong> - TechCorp</p>
        </div>
        <div class="card">
          <p>“Excelente ferramenta para gestão de vendas. Simples de usar e nos ajuda a manter o foco no que importa.”</p>
          <p><strong>Carlos Santos</strong> - Inovativa</p>
        </div>
        <div class="card">
          <p>“A organização do pipeline e os relatórios nos ajudam muito no dia a dia. O suporte é incrível.”</p>
          <p><strong>Patricia Lima</strong> - GlobalTech</p>
        </div>
      </div>
    </section>

    <!-- CTA / Contact -->
    <section id="contact" class="section cta">
      <h2>Comece a organizar suas vendas hoje</h2>
      <p>Experimente o SalesFlow gratuitamente por 14 dias!</p>
      <form class="form" onsubmit="event.preventDefault(); alert('Teste gratuito iniciado!');">
        <input type="text" placeholder="Seu nome" required />
        <input type="email" placeholder="Seu email" required />
        <input type="text" placeholder="Sua empresa" />
        <button type="submit">Começar Teste Grátis</button>
      </form>
    </section>
  </main>

  <!-- Footer -->
  <footer>
  <p>&copy; 2025 SalesFlow. Todos os direitos reservados.</p>
  <p>CNPJ: 12.345.678/0001-99</p>
  <p>
    <a 
      href="https://api.whatsapp.com/send?phone=5541995372945&text=Ol%C3%A1%2C%20tudo%20bem%3F%20Gostaria%20de%20conhecer%20mais%20o%20sistema." 
      target="_blank"
      style="color: #2563eb; text-decoration: none; font-weight: 500;"
    >
      Fale conosco no WhatsApp 📲
    </a>
  </p>
</footer>

</body>
</html>
