# AfrikaVibe - Laravel Web Application

AfrikaVibe is a modern, AI-enhanced, multilingual Laravel web platform showcasing African destinations, culture, cuisine, art, and travel insights. Built using Laravel 11, Livewire 3, and the TALL stack, it delivers an engaging and progressive user experience optimized for growth and discovery.

## Features

- **Laravel 11** with full MVC structure.
- **Livewire 3** for dynamic frontend interactivity.
- **Tailwind CSS** for modern, responsive UI.
- **Alpine.js** for lightweight JavaScript interactions.
- **Authentication** powered by Laravel Breeze.
- **CRUD operations** for domain models using Livewire.
- **Image Uploading & Display** using Laravel's Storage system (stored in `storage/app/public/profile-photos`).
- **Multilingual Support** including Arabic with RTL direction support.
- **AI Integrations** (planned):
  - GPT-4 for content generation and recommendations.
  - Google Cloud Translation for language switching.
  - Algolia for fast, relevant search.
  - Chatbot for user interaction.
- **Progressive Web App (PWA)** support for mobile-first engagement.
- **SEO & Meta Tag Optimization** on every major page.
- **Video Content Integration** from tools like InVideo AI and TikTok-ready formats.
- **Admin Panel** (in progress) for managing users, posts, media, and site content.
- **Related Blog Posts** display using category and tag-based filters.


## Installation

1. Clone the repository:

   ```bash
   git clone https://github.com/Dante-VIQ/afrikavibe.git
   cd afrikavibe

2. Install dependencies:

```bash
composer install
npm install
npm run build


3. Configure environment:

```bash
cp .env.example .env
php artisan key:generate


4. Set permissions (Linux/Mac):

```bash
chmod -R 775 storage bootstrap/cache


5. Run migrations:

<code>
php artisan migrate
</code>

6. Link storage:

```bash
php artisan storage:link


7. Serve the app:

```bash
php artisan serve



Tech Stack

Backend: Laravel 11, PHP 8.x

Frontend: Tailwind CSS, Alpine.js, Livewire 3

Package Tools: Vite, npm, Laravel responsecache

Database: MySQL / MariaDB

Hosting (Planned): Affordable Laravel-compatible shared hosting or PaaS

AI Tools: OpenAI, Google Cloud, Algolia (to be integrated)


Contributing

Contributions are welcome! Fork the repo and submit a PR. For major features, please open an issue first to discuss your ideas.

License

This project is open-source and available under the MIT license.


---

Made with passion by Daniel Mwangi — Showcasing the soul of Africa through technology.
