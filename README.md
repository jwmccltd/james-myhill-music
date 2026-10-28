# James Myhill Music

Application for James Myhill music including release info, portfolio of work etc. The system also has tools to manage playlists via the Spotify API as well as a mechanism to mirror these playlists in Soundcloud and integration to automate Instagram Reels. The project uses the npm package "@jwmccltd/slideshow-with-text-transition" by the same author to run the slideshow component on page load.

## Stack

- PHP 8.1+ and Laravel 11
- MySQL (or another Laravel-supported database)
- Vue 3, Vite, Sass, and Bootstrap 5
- Spotify and SoundCloud integrations; optional Instagram Graph API tooling

## Requirements

- PHP 8.1 or newer with the extensions required by Laravel
- Composer
- Node.js and npm
- MySQL

## Local development

1. Install PHP dependencies:

   ```sh
   composer install
   ```

2. Create `.env` and generate the application key:

   ```sh
   touch .env
   php artisan key:generate
   ```

3. Configure the database in `.env`, then apply migrations:

   ```sh
   php artisan migrate
   ```

4. Install frontend dependencies and start Vite:

   ```sh
   npm install
   npm run dev
   ```

5. In a separate terminal, serve Laravel:

   ```sh
   php artisan serve
   ```

The site is available at `http://localhost:8000`. For production assets, run `npm run build` and configure the web server document root to `public/`.

## Routes

- `/` — homepage with featured release, selected compositions, and portfolio
- `/playlists` — Spotify and SoundCloud playlist embeds
- `/soundcloud` and `/soundcloud-auth` — SoundCloud connection and callback routes

## Integrations and scheduled work

Spotify and SoundCloud credentials are read from environment variables via `config/spotify.php` and `config/soundcloud.php`. Playlist automation also depends on database records for users, playlists, credentials, and playlist configuration. Instagram reel commands use the optional values in `config/instagram.php` and stored Instagram token credentials. Keep secrets in `.env`; do not commit credentials.

Laravel's scheduled tasks are defined in `routes/console.php`:

- `app:run-config` runs hourly at 5 minutes past the hour.
- `app:generate-soundcloud-playlists` runs hourly at 45 minutes past the hour.
- `app:refresh-tokens` runs every 30 minutes.

To run the scheduler in production, configure the host's cron to invoke Laravel's scheduler once per minute:

```cron
* * * * * cd /path/to/project && php artisan schedule:run >> /dev/null 2>&1
```

Other available Artisan commands cover playlist configuration, token refresh, playlist generation, and Instagram reel creation/upload. Run `php artisan list` for the current command list. Some commands require external service credentials, persisted tokens, media files, or `ffmpeg`.

## Docker

`docker-compose.yml` defines a Laravel Sail development container. After configuring the environment and installing the Sail dependencies, use Sail's `up` command to start it. The compose file maps the application to `APP_PORT` (default `80`) and Vite to `VITE_PORT` (default `5173`).

## Project layout

- `app/` — Laravel controllers, services, models, jobs, and console commands
- `resources/views/` — Blade pages and layouts
- `resources/js/` and `resources/scss/` — Vue components and frontend styles
- `public/` — public assets and Laravel's web entry point
- `routes/` — web, API, console, and channel routes
- `database/migrations/` — database schema migrations

