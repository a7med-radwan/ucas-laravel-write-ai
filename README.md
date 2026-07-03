<div align="center">

# ✍️ Write AI

**A smart blogging platform powered by Artificial Intelligence**

[![Laravel](https://img.shields.io/badge/Laravel-13.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![TailwindCSS](https://img.shields.io/badge/TailwindCSS-4.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white)](https://tailwindcss.com)
[![License](https://img.shields.io/badge/License-MIT-green?style=for-the-badge)](LICENSE)

*Built with Laravel 13 and the official Laravel AI SDK.*

</div>

---

## What is Write AI?

Write AI is a modern blogging platform where users can write, publish, and discover articles. It uses AI to help writers generate content, improve SEO, and find related posts through smart search.

---

## Features

### AI Features
- **AI Writer** — Automatically generate full articles using Groq models
- **SEO Agent** — Auto-generate SEO title, description, summary, and keywords using Gemini
- **Vector Search** — Find related posts using semantic similarity (Gemini Embeddings)
- **Related Posts** — Suggest similar articles based on content or tags

### Content Management
- Create, edit, and delete posts with soft delete and restore support
- Organize posts with **Categories** and **Tags**
- Upload a **cover image** for each post
- Auto-calculate **reading time**
- Post statuses: `draft`, `published`, `archived`
- Safe content editor — HTML is sanitized automatically

### Community & Engagement
- **Follow / Unfollow** other users
- **Bookmark** posts to read later
- **Comment** on posts
- **Real-time notifications** via WebSockets (Laravel Echo + Reverb)
- Public user profile pages

### Authentication & Security
- Full auth system via **Laravel Fortify**
- **Two-Factor Authentication (2FA)** using TOTP
- **Passkeys** support (WebAuthn — passwordless login)
- **Roles & Permissions** system
- API authentication via **Laravel Sanctum**
- Email verification

### Dashboard
- User dashboard to manage their own posts
- Admin dashboard to manage users and roles
- Category management (admin and super-admin only)

---

## Project Structure

```
write-ai/
├── app/
│   ├── Actions/                 # Business actions (file upload, tag sync, auth)
│   ├── Ai/
│   │   └── Agents/
│   │       ├── SeoAgent.php     # Generates SEO metadata (Gemini)
│   │       └── WriterAgent.php  # Generates article content (Groq)
│   ├── Enums/
│   │   └── PostStatus.php       # Draft / Published / Archived
│   ├── Events/                  # Broadcasting events
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── AdminDashboard/  # Admin panel controllers
│   │   │   ├── Api/             # REST API controllers
│   │   │   └── Dashboard/       # User dashboard controllers
│   │   ├── Middleware/
│   │   ├── Requests/            # Form validation
│   │   └── Resources/           # API response formatting
│   ├── Jobs/                    # Background jobs
│   ├── Listeners/               # Event listeners
│   ├── Mail/                    # Email templates
│   ├── Models/
│   │   ├── Post.php             # Post model (with Embeddings support)
│   │   ├── User.php             # User model
│   │   ├── Category.php
│   │   ├── Tag.php
│   │   ├── Comment.php
│   │   └── Role.php
│   ├── Notifications/
│   ├── Observers/
│   ├── Policies/                # Authorization policies
│   ├── Providers/
│   ├── Rules/                   # Custom validation rules
│   └── Services/
│       └── PostService.php      # Post creation and update logic
├── database/
│   ├── factories/               # Test data factories
│   ├── migrations/              # Database migrations
│   └── seeders/
├── resources/                   # Blade views, CSS, JS
├── routes/
│   ├── web.php                  # Web routes
│   ├── api.php                  # API routes
│   ├── channels.php             # Broadcast channels
│   └── console.php
└── tests/
    ├── Feature/                 # Integration tests
    └── Unit/                    # Unit tests
```

---

## Database Tables

| Table | Description |
|-------|-------------|
| `users` | Users with roles, status, timezone, and avatar |
| `posts` | Posts with soft deletes, embeddings, and SEO data |
| `categories` | Post categories (with subcategory support) |
| `tags` + `post_tag` | Tags and their many-to-many relation with posts |
| `comments` | User comments on posts |
| `followers` | Follow relationships between users |
| `bookmarks` | Saved posts per user |
| `roles` + `role_user` | Roles and permissions |
| `notifications` | Database notifications |
| `agent_conversations` | AI agent conversation history |
| `passkeys` | WebAuthn keys for passwordless login |
| `personal_access_tokens` | Sanctum API tokens |

---

## Installation

### Requirements

| Tool | Version |
|------|---------|
| PHP | `>= 8.3` |
| Composer | `>= 2.x` |
| Node.js | `>= 18.x` |
| Database | SQLite or MySQL |

### Quick Setup

```bash
# Clone the repo
git clone https://github.com/aradwan/write-ai.git
cd write-ai

# Install everything at once
composer run setup
```

Or step by step:

```bash
composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate

npm run build
```

---

## Environment Variables

Copy `.env.example` to `.env` and fill in your values:

```env
# Database — SQLite by default
DB_CONNECTION=sqlite

# For MySQL instead:
# DB_CONNECTION=mysql
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=write_ai
# DB_USERNAME=root
# DB_PASSWORD=

# AI providers
GEMINI_API_KEY=your_gemini_api_key
GROQ_API_KEY=your_groq_api_key

# WebSockets (Reverb)
BROADCAST_CONNECTION=reverb
REVERB_APP_ID=your_app_id
REVERB_APP_KEY=your_app_key
REVERB_APP_SECRET=your_app_secret
REVERB_HOST=localhost
REVERB_PORT=8080

# Queue
QUEUE_CONNECTION=database

# Email
MAIL_MAILER=smtp
MAIL_HOST=your_mail_host
MAIL_PORT=587
MAIL_USERNAME=your_email
MAIL_PASSWORD=your_password
```

---

## Running the Project

```bash
composer run dev
```

This runs all services at once:
- 🌐 **Laravel server**
- 🔄 **Queue worker**
- 📋 **Log viewer (Pail)**
- ⚡ **Vite dev server**

Or run each one separately:

```bash
php artisan serve
php artisan queue:listen
php artisan reverb:start
npm run dev
```

---

## AI Agents

### WriterAgent
Generates a full article (title + content) using a Groq model.

```php
$agent = new WriterAgent();
$response = $agent->prompt('Write an article about Laravel 13 new features');
// Returns: ['title' => '...', 'content' => '...']
```

### SeoAgent
Analyzes a post and returns structured SEO data using Gemini.

```php
$agent = new SeoAgent();
$meta = $agent->prompt("Generate SEO for: {$post->title}\n{$post->content}");
// Returns: ['title', 'description', 'summary', 'keywords' => [...]]
```

### Vector Search
Uses Gemini Embeddings to find semantically similar posts.

```php
$related = $post->related(limit: 3, same_category: true);
```

---

## Routes Overview

### Public Routes
| Route | Description |
|-------|-------------|
| `GET /` | Home page |
| `GET /posts/{slug}` | View a post |
| `GET /search` | Search posts |
| `GET /u/{username}` | User profile |
| `ANY /ai/posts/write` | AI post writer |

### Dashboard Routes (requires login)
| Route | Description |
|-------|-------------|
| `GET /dashboard/posts` | My posts list |
| `POST /dashboard/posts` | Create a new post |
| `GET /dashboard/posts/{post}/edit` | Edit a post |
| `PUT /dashboard/posts/{post}/restore` | Restore deleted post |
| `GET /dashboard/notifications` | Notifications |

### Admin Routes (requires admin role)
| Route | Description |
|-------|-------------|
| `GET /admin/users` | Manage users |
| `GET /admin/roles` | Manage roles (super-admin only) |

---

## Testing

```bash
# Run all tests
php artisan test --compact

# Run unit tests only
php artisan test --testsuite=Unit

# Run a specific test
php artisan test --filter=PostCreateServiceTest
```

---

## Tech Stack

### Backend
| Package | Version | Purpose |
|---------|---------|---------|
| `laravel/framework` | v13 | Core framework |
| `laravel/ai` | v0 | Official AI SDK |
| `laravel/fortify` | v1 | Authentication |
| `laravel/sanctum` | v4 | API authentication |
| `laravel/reverb` | v1 | WebSockets server |
| `lorisleiva/laravel-actions` | v2 | Actions pattern |
| `pusher/pusher-php-server` | v7 | Pusher protocol |

### Frontend
| Package | Version | Purpose |
|---------|---------|---------|
| `tailwindcss` | v4 | CSS framework |
| `laravel-echo` | v2 | WebSocket client |
| `pusher-js` | v8 | Pusher browser client |
| `vite` | v8 | Build tool |

### Dev Tools
| Tool | Purpose |
|------|---------|
| `laravel/pint` | Auto code formatting |
| `laravel/pail` | Interactive log viewer |
| `laravel/boost` | MCP dev tools |
| `phpunit/phpunit` v12 | Testing framework |

---

## Useful Commands

```bash
# Format code
vendor/bin/pint --dirty

# List all routes
php artisan route:list --except-vendor

# Run seeders
php artisan db:seed

# Clear all cache
php artisan optimize:clear

# Watch logs
php artisan pail

# Show a config value
php artisan config:show app.name
```

---

## Security

- HTML is sanitized in `title` and `content` fields to prevent XSS
- CSRF protection on all forms
- Passwords are hashed with bcrypt (12 rounds)
- Role-based access control for all protected routes
- Two-factor authentication (TOTP) and Passkeys support

---

## Contributing

1. Fork the project
2. Create a new branch: `git checkout -b feature/your-feature`
3. Make your changes and format the code: `vendor/bin/pint --dirty`
4. Run tests: `php artisan test --compact`
5. Push your branch: `git push origin feature/your-feature`
6. Open a Pull Request

---

## License

This project is licensed under the [MIT License](LICENSE).

---

<div align="center">

Built with ❤️ using **Laravel 13** and the **Laravel AI SDK**

</div>
