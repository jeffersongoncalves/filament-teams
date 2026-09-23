# Changelog

All notable changes to `filament-teams` will be documented in this file.

## 1.2.0 - 2026-09-23

### What's new

- **Translations:** 17 new locales (ar, az, de, es, fa, fr, hi, it, ja, nl, pl, pt, ru, tr, uk, uz, zh_CN). (#20)

Thanks to @Elvin-Qulizade (Elvin Qulizada) for the i18n initiative behind these translations — first contributed in jeffersongoncalves/filament-scanner-guard#2 and now rolled out across the Filament plugins. He is credited as co-author.

### What's Changed

* ci: standardize update-changelog workflow (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/11
* build(deps): Bump the actions-deps group with 3 updates by @dependabot[bot] in https://github.com/jeffersongoncalves/filament-teams/pull/16
* ci: standardize tests workflow (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/17
* feat(i18n): add translations (1.x) by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/20

**Full Changelog**: https://github.com/jeffersongoncalves/filament-teams/compare/1.1.0...1.2.0

## 1.1.0 - 2026-09-07

### What's Changed

* docs: add Buy Me a Coffee sponsor link by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/5
* chore: add Buy Me a Coffee to FUNDING.yml by @jeffersongoncalves in https://github.com/jeffersongoncalves/filament-teams/pull/8

**Full Changelog**: https://github.com/jeffersongoncalves/filament-teams/compare/1.0.0...1.1.0

## 1.0.0 - 2026-06-23

### Added

- Initial release for Filament v3.
- Multi-tenancy powered by Teams, memberships and team invitations.
- `HasTeams` trait for the application `User` model.
- Tenant registration (`RegisterTeam`) and tenant profile (`EditTeamProfile`) pages.
- `TeamInvitationAccept` page for accepting or declining invitations.
- Optional admin resources for managing Teams and Team Invitations.
- Publishable configuration and migrations.
