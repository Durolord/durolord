# Durolord • Portfolio & Digital Realm

A mystical, Soulslike-inspired portfolio built with the **TALL stack** (Tailwind, Alpine.js, Laravel, Livewire).  
This site showcases my work as a **Senior Laravel Developer & Maker of Digital Realms**, with a unified design system powered by the **DURO Code** color palette.

This project also serves as the **host application** for my internal tools:  
- HRMS (Human Resource Management System)  
- CMS (Content Management System)  
- Church Message Tracker  
- Developer Sandbox  

All backend modules share a **single theme, aesthetics, and component system**.

---

## ✨ Features

### 🌟 Public Portfolio
- Hero section with DURO branding and custom aurora gradients  
- Project showcase (Livewire-driven)  
- Contact section  
- Fully responsive  
- Light & Dark mode  
- Soulslike-inspired UI elements, rune borders, glow styles, and energy gradients  

### 🧩 Backend Integration Architecture
The portfolio contains multiple internal modules mounted behind authentication:
- `/hrms` – Human Resource Management System  
- `/cms` – Content/Posts management  
- `/church` – Sermon archive + message tracker  
- `/admin` – Global dashboards & system tools  

All modules use:
- Shared **backend layout**  
- Shared **colors**  
- Shared **button/input components**  
- Shared **auth system (Laravel Fortify + Livewire UI)**  

---

## 🛠 Tech Stack

- **Laravel 12**  
- **Livewire 3**  
- **Alpine.js**  
- **Tailwind CSS (with DURO custom color system)**  
- **Vite**  
- **Spatie Roles & Permissions**  
- **Pest** (testing)

---

## 🎨 Design System (DURO)

The project uses a custom OKLCH-based color palette:
- Electric spectrum  
- Gold spectrum  
- Silver spectrum  
- Shadow spectrum  
- Neutral spectrum

Reusable components:
- Buttons  
- Inputs  
- Cards  
- Aurora background  
- Rune-corner SVG sprite  

---

## 🚀 Installation

```bash
git clone https://github.com/yourname/portfolio.git
cd portfolio
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate --seed
npm run build
