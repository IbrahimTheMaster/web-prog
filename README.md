# Web Programming Seminar — Group Project

A PHP web application built on the **Front Controller** pattern (course Solution-2 with user management), extended to meet the seminar homework requirements. The public site theme and data model should match **one database source** chosen from the course Google Drive folder (replace placeholders below once you select it).

## Stack

- **PHP** — routing, sessions, forms, PDO database access  
- **HTML5** — semantic structure, horizontal navigation  
- **CSS** — layout, responsive design  
- **JavaScript** — client-side form validation and UI behaviour  

## Architecture (Front Controller)

- Entry point: [`index.php`](index.php) reads `QUERY_STRING` and resolves the active page from `$pages` in [`includes/config.inc.php`](includes/config.inc.php).
- Optional per-page logic: [`logicals/{page}.php`](logicals/) (included from [`templates/index.tpl.php`](templates/index.tpl.php) when present).
- Layout and page body: [`templates/index.tpl.php`](templates/index.tpl.php) and [`templates/pages/{page}.tpl.php`](templates/pages/).

## Project structure

| Path | Purpose |
|------|---------|
| `includes/` | Global config (e.g. `config.inc.php`) |
| `logicals/` | PHP logic loaded before templates |
| `templates/` | Main layout; `pages/` holds per-route templates |
| `styles/` | CSS |
| `images/` | Static images (e.g. logo) |
| `uploads/` | *(when implemented)* user-uploaded gallery files — do not commit large binaries if policy requires |
| `databaselesson.sql` | Sample SQL — **replace or extend** with your chosen dataset import |

## Local setup

This folder is both the **Git repository root** (when you run `git init` here) and the **web application root** for local hosting.

1. **Web server:** Point the document root at this directory, or run PHP’s built-in server from this folder (e.g. `php -S localhost:8080`).
2. **Database:** Create a MySQL/MariaDB database; import your chosen SQL dump (start from `databaselesson.sql` if still applicable).
3. **Configuration:** Set PDO connection parameters in `includes/config.inc.php` for your local DB. For production/hosting, prefer a non-committed local override (e.g. `config.local.inc.php`) so passwords are not pushed to GitHub.

## Homework requirements (checklist)

Use this list when implementing and when writing the PDF documentation (with screenshots and URLs).

- [ ] **Front Controller** — extend the provided Solution-2 pattern (mandatory base).
- [ ] **Responsive design** — usable on small and large screens.
- [ ] **HTML5 + horizontal menu** — semantic elements; main navigation horizontal.
- [ ] **Registration / Login / Logout** — menu rules: Login visible when logged out; Logout when logged in; combined login/register entry as specified; **no auto-login after registration**; header shows: `Logged-in: Family_name Surname (Login_name)` when applicable.
- [ ] **Guest menus:** Mainpage, Images, Contact, CRUD, Login (when not logged in).
- [ ] **Mainpage** — themed intro; **two videos** (one local ≤5 s, one e.g. YouTube); **Google Map** for the site’s chosen address.
- [ ] **Images** — gallery; **upload only for logged-in** users.
- [ ] **Contact** — form to message the owner; **client + server validation** (not relying on HTML-only checks as per assignment); store in DB; **fifth page** showing submitted content as specified.
- [ ] **Messages** — logged-in only; table from DB, **newest first**; time + sender name, **“Guest”** for non-logged-in senders.
- [ ] **CRUD** — import tables from chosen DB files; full CRUD on **one** table with routed pages.
- [ ] **Hosting** — deploy publicly; document URL and FTP/credentials in the PDF.
- [ ] **GitHub** — **public** repo; **at least five** incremental commits (partial states), not a single final dump.
- [ ] **Language** — English sitewide.
- [ ] **Documentation** — each member submits `Name-NeptunCode.pdf` (15+ pages, screenshots, GitHub + live URLs, where each requirement was implemented).

## Credits

Group work. **Which member implemented which part** must be stated in the **submitted PDF documentation** (and reflected in Git history with correct `user.name` / email per contributor).

## Links (fill in after deployment)

- **Live site:** _TBD_
- **GitHub repository:** _TBD_
