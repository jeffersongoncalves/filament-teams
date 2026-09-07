# Changelog

All notable changes to `filament-teams` will be documented in this file.

## 3.0.1 - 2026-09-06

### What's Changed

* build(deps): Bump ramsey/composer-install from 3 to 4 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-teams/pull/3
* build(deps): Bump actions/checkout from 4 to 7 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-teams/pull/2
* build(deps): Bump stefanzweifel/git-auto-commit-action from 6 to 7 by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-teams/pull/1
* docs: add Buy Me a Coffee sponsor link by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/4
* chore: add GitHub Sponsors to FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/7

### New Contributors

* @dependabot[bot] made their first contribution in https://github.com/jeffersongoncalves/filament-teams/pull/3

**Full Changelog**: https://github.com/jeffersongoncalves/filament-teams/compare/3.0.0...3.0.1

## 3.0.0 - 2026-06-23

### Added

- Initial release for Filament v5.
- Multi-tenancy powered by Teams, memberships and team invitations.
- `HasTeams` trait for the application `User` model.
- Tenant registration (`RegisterTeam`) and tenant profile (`EditTeamProfile`) pages.
- `TeamInvitationAccept` page for accepting or declining invitations.
- Optional admin resources for managing Teams and Team Invitations.
- Publishable configuration and migrations.
