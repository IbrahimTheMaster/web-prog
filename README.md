# Web Programming Seminar Project

This repository contains our seminar homework built from the **7a Front Controller (Solution-2)** base provided in class.  
The goal is to extend that base step by step and keep clear GitHub history from both team members.

## Tech Used

- PHP
- HTML5
- CSS
- JavaScript
- MySQL / MariaDB

## Project Idea

Our website theme is a **city explorer portal**.  
The pages are organized through the front controller and route config in:

- `index.php`
- `includes/config.inc.php`
- `templates/index.tpl.php`

## Folder Overview

- `includes/` - app configuration and route setup
- `logicals/` - page-specific PHP logic
- `templates/` - main layout and route templates
- `styles/` - CSS files
- `images/` - static assets and local short video
- `databaselesson.sql` - base SQL schema used in development
- `city_places_schema.sql` - selected dataset table used for CRUD (Day 4)

## Run Locally

1. Open this folder as the project root.
2. Import SQL into your local database.
3. Update DB connection values in `includes/config.inc.php`.
4. Run with local web server (Apache or `php -S localhost:8080` from this folder).

## Professor Checklist (Implementation Targets)

- [x] Start from Solution-2 front controller base
- [x] Horizontal menu structure prepared
- [x] Basic responsive layout started
- [x] Mainpage includes:
  - local video (<=5 seconds)
  - embedded YouTube video
  - Google map section
- [ ] Registration / login / logout behavior final verification
- [ ] Images page with upload (logged-in users only)
- [ ] Contact form with JS + PHP validation
- [ ] Contact data storage and result page
- [ ] Messages page (logged-in only, newest first, Guest fallback)
- [ ] CRUD for one selected imported table
- [ ] Final hosting deployment
- [ ] PDF documentation (15+ pages) with screenshots and full requirement mapping

## GitHub Workflow for Grading

- Repository is public.
- Work is committed in small steps (not one final upload).
- Both contributors must appear in commit history with their own Git identities.
- Contribution split will be explained in submitted PDF documentation.

## Notes

- Site language is English (required by assignment).
- Do not commit private credentials.
- Internal planning notes are kept out of GitHub using `.gitignore`.

## Links

- Live URL: _to be added after deployment_
- GitHub URL: _to be added after final review_
