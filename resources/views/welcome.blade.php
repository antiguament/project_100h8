<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <style>
        :root {
            --color-primary: #6366f1;
            --color-primary-dark: #4f46e5;
            --color-dark: #1e293b;
            --color-light: #f8fafc;
            --color-gray: #64748b;
            --color-gray-light: #e2e8f0;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-light);
            color: var(--color-dark);
            line-height: 1.6;
        }
        
        .dark body {
            background-color: var(--color-dark);
            color: var(--color-light);
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1rem;
        }
        
        header {
            padding: 1.5rem 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .logo {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-primary);
            text-decoration: none;
        }
        
        .nav-links {
            display: flex;
            gap: 1.5rem;
        }
        
        .nav-links a {
            color: var(--color-gray);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s;
        }
        
        .nav-links a:hover {
            color: var(--color-primary);
        }
        
        .btn {
            display: inline-block;
            padding: 0.5rem 1.25rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s;
        }
        
        .btn-primary {
            background-color: var(--color-primary);
            color: white;
        }
        
        .btn-primary:hover {
            background-color: var(--color-primary-dark);
            transform: translateY(-1px);
        }
        
        .btn-outline {
            border: 1px solid var(--color-gray-light);
            color: var(--color-dark);
        }
        
        .dark .btn-outline {
            border-color: #334155;
            color: var(--color-light);
        }
        
        .btn-outline:hover {
            border-color: var(--color-primary);
            color: var(--color-primary);
        }
        
        .hero {
            padding: 5rem 0;
            text-align: center;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(to right, var(--color-primary), #8b5cf6);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        .hero p {
            font-size: 1.25rem;
            color: var(--color-gray);
            max-width: 700px;
            margin: 0 auto 2.5rem;
        }
        
        .cta-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
        }
        
        .features {
            padding: 5rem 0;
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background-color: white;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        
        .dark .feature-card {
            background-color: #1f2937;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .feature-icon {
            width: 3rem;
            height: 3rem;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: rgba(99, 102, 241, 0.1);
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            color: var(--color-primary);
        }
        
        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        
        .feature-card p {
            color: var(--color-gray);
        }
        
        footer {
            padding: 3rem 0;
            text-align: center;
            color: var(--color-gray);
            border-top: 1px solid var(--color-gray-light);
        }
        
        .dark footer {
            border-top-color: #334155;
        }
        
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .cta-buttons {
                flex-direction: column;
                align-items: center;
            }
        }
    </style>
</head>
<body class="dark:bg-gray-900">
    <div class="container">
        <header>
            <a href="/" class="logo">Laravel</a>
            <nav class="nav-links">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="btn btn-outline">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                        @endif
                    @endauth
                @endif
            </nav>
        </header>

        <section class="hero">
            <h1>Build something amazing with Laravel</h1>
            <p>The PHP framework for web artisans. Laravel is a web application framework with expressive, elegant syntax.</p>
            <div class="cta-buttons">
   
                <a href="{{ route('vista-1') }}" class="btn btn-outline">Vista 1</a>
            </div>

            </div>
        </section>

        <section class="features">
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                            <polyline points="13 2 13 9 20 9"></polyline>
                        </svg>
                    </div>
                    <h3>Expressive Syntax</h3>
                    <p>Enjoy the clean, elegant syntax that makes development a joy. Laravel values beauty and simplicity.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 2v4"></path>
                            <path d="m16.24 7.76 2.83-2.83"></path>
                            <path d="M18 12h4"></path>
                            <path d="m16.24 16.24 2.83 2.83"></path>
                            <path d="M12 18v4"></path>
                            <path d="m4.93 19.07 2.83-2.83"></path>
                            <path d="M2 12h4"></path>
                            <path d="m4.93 4.93 2.83 2.83"></path>
                        </svg>
                    </div>
                    <h3>Modular Packaging</h3>
                    <p>Laravel's robust package system makes it easy to add functionality to your applications.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m8 3 4 8 5-5 5 15H2L8 3z"></path>
                        </svg>
                    </div>
                    <h3>Powerful Tools</h3>
                    <p>Eloquent ORM, Blade templating, queue system, and more give you the tools you need for any project.</p>
                </div>
            </div>
        </section>

        <footer>
            <p>&copy; {{ date('Y') }} Laravel. All rights reserved.</p>
        </footer>
    </div>

    <!-- Dark mode toggle script -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
</body>
</html>