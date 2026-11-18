# Deployment Steps – democracyasia.com

| | |
|---|---|
| Server | Hostinger VPS (Ubuntu 24.04) – `187.127.151.112` |
| App folder | `/var/www/democracyasia` |
| Branch | `main` (GitHub: `Warrgyizmorsch/news-article`) |
| Web server | nginx |

---

## 1. Push your changes (on your computer)

```bash
git add .
git commit -m "Describe your change"
git push origin main
```

## 2. Open the server

hPanel → **VPS** → **Web console**
(or from a terminal: `ssh root@187.127.151.112`)

## 3. Go to the app folder

```bash
cd /var/www/democracyasia
```

## 4. Check for edits made directly on the server

```bash
git status --short --untracked-files=no
```

- **No output** → safe, continue.
- **Files listed** → someone edited code on the server. Copy those changes into the repo first (or run `git stash`), otherwise the pull may fail or overwrite them.

> Untracked uploads (`public/uploads/…`, `public/images/`) are normal and can be ignored.

## 5. Pull the latest code

```bash
git pull origin main
```

Look at the list of changed files in the output – it tells you which of the next steps are needed.

## 6. Install PHP packages *(only if `composer.json` / `composer.lock` changed)*

```bash
composer install --no-dev --optimize-autoloader
```

## 7. Run database migrations *(only if files in `database/migrations/` changed)*

```bash
php artisan migrate --force
```

## 8. Build front-end assets *(only if `package.json`, `resources/js` or `resources/css` changed)*

```bash
npm ci && npm run build
```

## 9. Clear and rebuild caches *(always)*

```bash
php artisan optimize:clear
php artisan config:cache
php artisan view:cache
php artisan queue:restart
```

## 10. Fix folder permissions *(only if you see “permission denied” errors)*

```bash
chown -R www-data:www-data storage bootstrap/cache
```

## 11. Check the live site

- Home page: https://democracyasia.com/
- Open one article page
- Test anything you changed

---

## Quick version (most updates)

```bash
cd /var/www/democracyasia
git status --short --untracked-files=no
git pull origin main
php artisan migrate --force
php artisan optimize:clear && php artisan config:cache && php artisan view:cache
```

---

## If something goes wrong

**See the error:**
```bash
tail -n 50 storage/logs/laravel.log
```

**Roll back to the previous version:**
```bash
git log --oneline -5          # find the previous commit id
git reset --hard <commit-id>  # go back to it
php artisan optimize:clear && php artisan config:cache && php artisan view:cache
```
> Only roll back code. If the bad update ran a migration, ask a developer before running `php artisan migrate:rollback` – it can delete data.

**Site shows “Service Unavailable” (stuck in maintenance mode):**
```bash
php artisan up
```

---

## Notes

- Never edit code directly on the server – always change it locally, push, then pull.
- `.env` lives only on the server and is not in git. Don't overwrite it.
- After Ubuntu shows **“System restart required”**, reboot from hPanel at a quiet time (≈1 min downtime).
