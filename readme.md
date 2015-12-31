# Harleen

## Todo
- [ ] Add intermediate table attributes of contractor_working_area.
- [ ] Create Play store method.
- [x] Find way to bind nice name with multiple model while error.
- [ ] Associate each model attributes with nice name.

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
- Added Quinzel namespace to hold any business related logic.
- Added Resources.php in Quinzel.
- Updated ResourcesController index to get montageTable from Resources.php.
- Changed montagaTable to workingAreaTotal and added basinSeparator param.
- Added icon on navbar menu.
- Added BlockUi library.
- Fixed resetAllUserPass resetting developer and administrator user password.
- Added POST route to account/reset/all.
- Moved test user after GeneralSeeder and ResourcesSeeder.
- Added Maatwebsite/Excel to support Excel.
- Added exportNewUserPass in AccountController to download newly created username and password and bind with account/reset/all/export.
- Added summaryWorkingArea in ResourcesController act as montage for working area.

## Changelog 0.3
- Updated summary working area page.
- Deleted hist_working_area table.
- Created re_play table.
- Created re_lead table.
- Added helper function createNavTitle.
- Added PlayController.
- Added helper function createPlayName.
- Added Play Index page.
- Added only Pertamina EP that show basin column for any resources index.
- Added Play create action and views.
- Added GCF shared form.
- Added model WorkingArea, Contractor, Play, Gcf.
- Added PlayRepository in Quinzel.
- Changed all deleted_at columns with native migration method softDeletes.
- Added aaSorting to retain default sort order from server.
- Added index method in PlayRepository.
- Added LaravelCollective html package.
- Created shared.components directory to hold any custom form components.
- Changed required english error message.
- Created PlayFormRequest.
- Added isRequired in Request base class.

## Changelog 0.4
- Added form components registration in boot method.
- Created text.blade.php form components.
- Created select.blade.php form components.
- Added sugar coat components.
- Added Province model.