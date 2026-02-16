<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="300" alt="Laravel Logo">
</p>

<h1 align="center">🚀 Agenda Pro</h1>

<p align="center">
  <strong>SaaS Multi-Tenant API para Agendamentos Profissionais</strong>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-12-red" />
  <img src="https://img.shields.io/badge/PHP-8.2-blue" />
  <img src="https://img.shields.io/badge/Multi--Tenant-Enabled-success" />
  <img src="https://img.shields.io/badge/API-First-orange" />
  <img src="https://img.shields.io/badge/Status-Em%20Desenvolvimento-yellow" />
</p>

---

## 📌 Sobre o Projeto

O **Agenda Pro** é uma API SaaS multi-tenant construída para profissionais autônomos e pequenas empresas que precisam de um sistema de agendamento escalável.

Este projeto foi desenvolvido com foco em:

- 🔐 Autenticação segura via Laravel Sanctum  
- 🏢 Isolamento completo de dados por tenant  
- ⚡ Arquitetura API-first  
- 📈 Estrutura preparada para crescimento SaaS  
- 🧱 Base pronta para controle de planos  

---

## 🏗️ Arquitetura Multi-Tenant

Sistema implementado com:

- Tabela `tenants`
- `users.tenant_id`
- Middleware `tenant`
- Trait `BelongsToTenant`
- Global Scope automático
- Isolamento de dados por tenant

Cada cliente enxerga apenas seus próprios registros.

---

## 🔐 Autenticação

- Laravel Sanctum
- Token-based Authentication
- Rotas protegidas com:

```bash
auth:sanctum
tenant
```

📂 Estrutura Principal
```bash
app/
├── Models/
│   ├── Tenant.php
│   ├── Appointment.php
│   └── Concerns/BelongsToTenant.php
│
├── Http/
│   ├── Controllers/Api/AuthController.php
│   └── Middleware/EnsureTenant.php
│
routes/
└── api.php
```

🧪 Rotas Disponíveis
🔓 Públicas
```bash
POST /api/login
```
🔐 Protegidas
```bash
GET  /api/me
GET  /api/ping
GET  /api/appointments/test
POST /api/appointments/test
POST /api/logout
```
📦 Como Rodar o Projeto
```bash
git clone https://github.com/LeandroVPrado/agenda-pro.git
cd agenda-pro/backend
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

🧠 Roadmap

 Laravel configurado
 Sanctum implementado
 Login API funcionando
 Multi-tenant estruturado
 Isolamento validado
 CRUD completo de agendamentos
 Controle de planos
 Suspensão automática por vencimento
 Frontend Vue 3

🎯 Objetivo

Construir um SaaS real, escalável e comercializável para:
Profissionais autônomos
Clínicas
Salões
Prestadores de serviço

<p align="center"> <strong>Desenvolvido por Prado´s Web</strong><br> Desenvolvedor Fullstack • APIs • Sistemas Multi-Tenant </p> 



