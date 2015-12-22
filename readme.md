# Harleen

## Changelog 0.1
- Changed database name to 'sumberdaya'.
- Added create_initial_tables migration.
- Changed DatabaseSeeder to add test user.
- Added GeneralSeeder for general information about administration.
- Added ResourcesSeeder for Play, Lead, and Prospect.
- Changed timezone to Asia/Jakarta.
- Added old database config with name 'oldrps'.
- Removed default user and password migration.
- Removed Play ID on tested well zone, changed with formation name.
- Added tested well and tested well zone migration.
- Added discovery tested well zone migration.
- Added Semantic UI for CSS framework.
- Added getLogin in AuthController.
- Added SKK Migas favicon.ico, logo, and RTOR.
- Added login.blade.php view template.
- Added postLogin and getLogout in AuthController.
- Changed model User tables to 'user'.
- Added master.blade.php as main layout.
- Added AdministratorController and administrator index layout.
- Added DeveloperController and developer index layout
- Removed Semantic UI, go for Bootstrap.
- Fixed footer with Bootstrap.
- Fixed footer height size.
- Changed body background color to be darker.

## Changelog 0.2
- Upgraded to Laravel 5.2.
- Added ContractorController.
- Added recapitulation migration in initial tables.
- Changed on Lead and drillable seeder to use nameCleaner on closure name.
- Added nullable on Lead and Drillable migration structure name.
- Added DatabaseController and related views.
- Added AccountController and related views.
- Added helpers.php file.
- Changed RedirectIfAuthenticated middleware to check for role.
- Added RoutesAuthenticate to authenticate in routes level.
- Applied RoutesAuthenticate middleware to DeveloperController.
- Added account/reset/all route to AccountController @ resetAllUserPass.
- Added ResourcesController and related views.
- Added test administrator user in DatabaseSeeder.
- Added resources table in Resources views.
- Added jQuery DataTables library.