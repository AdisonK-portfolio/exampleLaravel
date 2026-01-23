This is an example for prospective employers; it is not meant to be a full website, rather, it is a growing collection of **prototype examples** of things that I can do and/or have experience in.  

To that end, I have gone down two routes for designing for this project- one is the non-Inertia route; using blade files and putting Vue components into them (these use the resources/views/app-noVite.blade.php app file). This is the method most familiar to me, so I'm including it, even if some prospective employers use Inertia.  The other is the Inertia route. I'll admit, Inertia is fairly new to me, but I'm including it as proof that I can pick up a functional knowledge of it fairly quickly.


**Pages to Note:**
- App/Http/Controllers/ContactsController 
    - Controller with export function and API endpoint, plus basic functions (index/create/store/edit/update)
- App/Exports/ContactsExport 
    - Join statements, Eloquent queries; sorting, filtering, searching, exporting
- database/migrations/[*/2025_11_19_072939_create_contacts_table] 
    - MySQL schema
- resources/pages/IndexContacts 
    - (Vue component, sorting/filtering data)

Index Pages:

- individual index pages (contactsIndex, etc.): have to be made individually, but give more flexibility on search parameters
- genericIndex page: provides a much faster option for implementing index pages, and allows for some customization (through the extraClasses method) but is limited as far as what filters are available, since they have to be available to all models that use it



Styling:
For styles that tend to be repeated often (input borders, table cells, etc.), I tend to set the styles in resources/css/app.css (still using Tailwind), rather than have long lists of Tailwind classes in the code.

