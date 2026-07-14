@extends('example.layouts.default.baseof')

@section('main')
@vite(['resources/css/app.css','resources/js/app.js'])

    @php
        $role = strtolower(auth()->user()->role ?? 'staff');

        if ($role === 'admin') {
            $sidebarFile = 'example.layouts.partials.admin-sidebar';
        } elseif (str_contains($role, 'manager') || str_contains($role, 'manajer')) {
            $sidebarFile = 'example.layouts.partials.manajer-sidebar';
        } else {
            $sidebarFile = 'example.layouts.partials.staff-sidebar';
        }
    @endphp

    @include('example.layouts.partials.navbar-dashboard')

    <div class="flex pt-24 overflow-hidden bg-gray-50">

        @include($sidebarFile)

        <div id="main-content" class="relative w-full h-full overflow-y-auto bg-gray-50 lg:ml-64">
            <main>
                @yield('content')
            </main>
            @include('example.layouts.partials.footer-dashboard')
        </div>
    </div>
@endsection