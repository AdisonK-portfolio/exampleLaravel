This is an example for prospective employers; it is not meant to be a full website, rather, it is a growing collection of small, **prototype examples** of things that I can do and/or have experience in.  

To that end, I have some pages that use Inertia and some that don't- using blade files instead (Vue components may be added to these at some point). Non-Inertia pages use the resources/views/app-noInertia.blade.php app file. Inertia pages use resources/views/app.blade.php. I'll admit, Inertia is fairly new to me, but I'm including it as proof that I can pick up a functional knowledge of it fairly quickly.


**Pages to Note:**
- App/Http/Controllers/ContactsController 
    - Controller with export function and API endpoint, middleware, plus basic functions (index/create/store/edit/update)
- App/Http/Requests/ContactRequest
    - input validation (along with ContactsController)
- App/Exports/ContactsExport 
    - Join statements, Eloquent queries; sorting, filtering, searching, exporting
- database/migrations/[*/2025_11_19_072939_create_contacts_table] 
    - MySQL schema
- resources/pages/IndexContacts 
    - Vue component, sorting/filtering data, responsive screen size design

** Other Notes **
- User authentication- using Laravel Fortify with a few modifications

Index Pages:

- individual index pages (contactsIndex, etc.): making them individually is more redundant, but give more flexibility on search parameters, etc.
- genericIndex page: provides a much faster option for implementing index pages, and allows for some customization (through the extraClasses method) but is limited as far as what filters are available, since they have to be available to all models that use it


Styling:
For styles that tend to be repeated often (input borders, table cells, etc.), I tend to set the styles in resources/css/app.css (still using Tailwind), rather than have long lists of Tailwind classes in the code.

