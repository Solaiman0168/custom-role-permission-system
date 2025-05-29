<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        .sidebar {
            width: 250px;
            min-height: 100vh;
        }
        .content {
            flex: 1;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="flex">
        <!-- Sidebar -->
        <div class="sidebar bg-gray-800 text-white p-4">
            <h1 class="text-xl font-bold mb-6">Admin Panel</h1>
            <nav>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Dashboard</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.permissions.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Permissions</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.roles.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Roles</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.index') }}" class="block px-4 py-2 hover:bg-gray-700 rounded">Users</a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="block w-full text-left px-4 py-2 hover:bg-gray-700 rounded">Logout</button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="content p-8">
            @if(session('success'))
                <div class="bg-green-500 text-white p-4 mb-4 rounded">
                    {{ session('success') }}
                </div>
            @endif
            
            @if(session('error'))
                <div class="bg-red-500 text-white p-4 mb-4 rounded">
                    {{ session('error') }}
                </div>
            @endif

            @yield('content')
        </div>
    </div>
</body>
</html>