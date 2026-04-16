# Two-Account GitHub Setup (Completed)

This file documents the exact setup completed for working on the same repository with two GitHub accounts from one machine.

## Accounts

- Account 1 (owner): `IbrahimTheMaster`  
  Email: `aliyuibraheem21@mail.com`
- Account 2 (collaborator): `king2245`  
  Email: `chikachineduss2@gmail.com`

## SSH Keys

Two SSH key pairs were generated and loaded:

- `~/.ssh/id_ed25519_github_account1` (+ `.pub`)
- `~/.ssh/id_ed25519_github_account2` (+ `.pub`)

SSH test results:

- `ssh -T git@github-account1` -> authenticated as `IbrahimTheMaster`
- `ssh -T git@github-account2` -> authenticated as `king2245`

## SSH Config

`~/.ssh/config` uses host aliases so each account uses its own key:

```ssh
Host github-account1
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519_github_account1
  IdentitiesOnly yes

Host github-account2
  HostName github.com
  User git
  IdentityFile ~/.ssh/id_ed25519_github_account2
  IdentitiesOnly yes
```

## Repository Strategy

Use two local clones for clean author attribution:

- `~/Documents/web-prog-ibrahim` (account 1 work)
- `~/Documents/web-prog-king2245` (account 2 work)

Both point to:

- `git@github-account1:IbrahimTheMaster/web-prog.git` (owner clone)
- `git@github-account2:IbrahimTheMaster/web-prog.git` (collaborator clone)

## Per-Clone Git Identity

In `web-prog-ibrahim`:

- `git config user.name "IbrahimTheMaster"`
- `git config user.email "aliyuibraheem21@mail.com"`

In `web-prog-king2245`:

- `git config user.name "king2245"`
- `git config user.email "chikachineduss2@gmail.com"`

## Private Planning File Rule

`TEAM-WORK.private.md` is intentionally ignored by Git:

```gitignore
*.private.md
```

This prevents accidental upload of planning notes.

## Daily Workflow

1. Work in the correct clone for the intended author.
2. Run `git pull origin main` before changes.
3. Make small, meaningful commits.
4. Push from that same clone.
5. In the other clone, pull latest before continuing.

## Notes

- Do not share passwords in repo/docs.
- Do not rewrite history unless absolutely necessary.
- Use collaborator access for account 2 to push directly to the owner repo.
