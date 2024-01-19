<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.profile') ? 'active' : '' }}" href="{{ route('company.edit.profile', [$company->id]) }}">Company Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.location') ? 'active' : '' }}" href="{{ route('company.edit.location', [$company->id]) }}">Company Location</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.structure') ? 'active' : '' }}" href="{{ route('company.edit.structure', [$company->id]) }}">Organizational Structure</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.products') ? 'active' : '' }}" href="{{ route('company.edit.products', [$company->id]) }}">Product and Service</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.customers') ? 'active' : '' }}" href="{{ route('company.edit.customers', [$company->id]) }}">Customers</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.information') ? 'active' : '' }}" href="{{ route('company.edit.information', [$company->id]) }}">Useful Information</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{request()->routeIs('company.edit.links') ? 'active' : '' }}" href="{{ route('company.edit.links', [$company->id]) }}">Useful Links</a>
        </li>
    </ul>
</div>