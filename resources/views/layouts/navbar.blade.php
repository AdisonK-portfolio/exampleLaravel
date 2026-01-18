<div class="bg-primary text-white">
    <div class="flex">
        <a href="/contacts"><div class="sm:px-6 px-4 py-2 {{ request()->path() == 'contacts' ? 'bg-primary-foreground' : '' }}">Contacts</div></a>
        <a href="/companies"><div class="sm:px-6 px-4 py-2 {{ request()->path() == 'companies' ? 'bg-primary-foreground' : '' }}">Companies</div></a>
        <a href="/users"><div class="sm:px-6 px-4 py-2 {{ request()->path() == 'users' ? 'bg-primary-foreground' : '' }}">Users</div></a>
    </div>
</div>