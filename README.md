This is an example site for prospective employers.  As such, it is not meant to be a full website on its own, rather, it is a collection of examples of things that I can do and/or have experience in.  

To that end, I have gone down two routes for designing for this project- one is the non-Inertia route; using blade files and putting Vue components into them (these use the resources/views/app-noVite.blade.php app file).  This is the method most familiar to me, so I'm including it, even if some prospective employers use Inertia.  The other is the Inertia route. I'll admit, Inertia is fairly new to me, but I'm including it as proof that I can pick up a functional knowledge of it fairly quickly.


Styling:
For styles that tend to be repeated often (input borders, table cells, etc.), I tend to set the styles in resources/css/app.css (still using Tailwind), rather than have long lists of Tailwind classes in the code.


Index Pages:
- genericIndex page: provides a much faster option for implementing index pages, and allows for some customization (through the extraClasses method) but is limited as far as what filters are available, since they have to be available to all models that use it
- individual index pages (contactsIndex, etc.): have to be made individually, but give more flexibility on search parameters

