<!DOCTYPE html>
<html lang="hu">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Postoffice</title>
    <style>
        * { box-sizing: border-box; }
        body { margin: 0; background: #f4f4f4; color: #222; font-family: Arial, sans-serif; }
        header { background: #1f2937; color: white; }
        .header-content, main { max-width: 1120px; margin: 0 auto; padding: 20px; }
        .header-content { display: flex; align-items: center; gap: 24px; }
        .brand { color: white; font-size: 20px; font-weight: 700; text-decoration: none; }
        nav { display: flex; gap: 14px; }
        nav a { color: #d1d5db; text-decoration: none; }
        nav a:hover, nav a.active { color: white; }
        main { padding-top: 28px; }
        .page-header { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 18px; }
        h1 { margin: 0; font-size: 26px; }
        .card { background: white; border: 1px solid #d1d5db; padding: 20px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 11px 10px; border-bottom: 1px solid #e5e7eb; text-align: left; vertical-align: middle; }
        th { background: #f9fafb; font-size: 14px; }
        tr:last-child td { border-bottom: 0; }
        .actions { display: flex; gap: 8px; align-items: center; }
        .button { display: inline-block; border: 1px solid #374151; background: #374151; color: white; padding: 8px 12px; text-decoration: none; font-size: 14px; cursor: pointer; }
        .button:hover { background: #111827; }
        .button.secondary { background: white; color: #374151; }
        .button.danger { border-color: #b91c1c; background: #b91c1c; }
        form { margin: 0; }
        .form-card { max-width: 620px; }
        .field { margin-bottom: 16px; }
        label { display: block; margin-bottom: 6px; font-weight: 700; }
        input, select { width: 100%; border: 1px solid #9ca3af; padding: 9px; font: inherit; }
        .error-list, .alert { padding: 12px; margin-bottom: 18px; }
        .error-list, .alert.error { border: 1px solid #ef4444; background: #fef2f2; color: #991b1b; }
        .alert.success { border: 1px solid #22c55e; background: #f0fdf4; color: #166534; }
        .muted { color: #6b7280; font-size: 14px; }
        .empty { color: #6b7280; text-align: center; padding: 26px; }
        .pagination { margin-top: 18px; }
        .pagination nav { display: block; }
        .pagination svg { width: 16px; height: 16px; }
        @media (max-width: 700px) { .header-content, .page-header { align-items: flex-start; flex-direction: column; } .card { overflow-x: auto; } }
    </style>
</head>
<body>
    <header>
        <div class="header-content">
            <a class="brand" href="{{ route('counties.index') }}">Postoffice</a>
            <nav>
                <a href="{{ route('counties.index') }}" class="{{ request()->routeIs('counties.*') ? 'active' : '' }}">Megyék</a>
                <a href="{{ route('cities.index') }}" class="{{ request()->routeIs('cities.*') ? 'active' : '' }}">Városok</a>
                <a href="{{ route('population.index') }}" class="{{ request()->routeIs('population.*') ? 'active' : '' }}">Lakosság</a>
            </nav>
        </div>
    </header>
    <main>
        @if (session('success'))
            <div class="alert success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert error">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="error-list">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>
</body>
</html>
