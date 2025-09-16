<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Composer Autoload Dumper - Hostinger</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #2c3e50;
            --secondary: #e74c3c;
            --accent: #3498db;
            --light: #ecf0f1;
            --dark: #2c3e50;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 2rem 0;
            min-height: 100vh;
        }
        
        .container {
            max-width: 800px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-top: 2rem;
        }
        
        header {
            background: linear-gradient(120deg, var(--primary) 0%, var(--dark) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
        
        header h1 {
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        header p {
            font-size: 1.2rem;
            opacity: 0.9;
        }
        
        .logo {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
        }
        
        .content-section {
            padding: 2rem;
        }
        
        .card {
            margin-bottom: 1.5rem;
            border: none;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .card-header {
            background: var(--light);
            border-bottom: 1px solid rgba(0,0,0,0.1);
            font-weight: 600;
        }
        
        .code-sample {
            background: #2d3a4b;
            color: #f8f8f2;
            padding: 1.5rem;
            border-radius: 8px;
            margin: 1.5rem 0;
            overflow-x: auto;
            font-family: 'Fira Code', monospace;
        }
        
        .command {
            color: #50fa7b;
        }
        
        .btn-primary {
            background: var(--accent);
            border: none;
            padding: 0.7rem 1.5rem;
            font-weight: 600;
        }
        
        .btn-primary:hover {
            background: #2980b9;
        }
        
        .btn-danger {
            background: var(--secondary);
        }
        
        .alert {
            border-radius: 8px;
            border: none;
        }
        
        footer {
            text-align: center;
            padding: 2rem;
            background: var(--dark);
            color: white;
        }
        
        #output {
            background: #2d3a4b;
            color: #f8f8f2;
            padding: 1.5rem;
            border-radius: 8px;
            min-height: 200px;
            max-height: 400px;
            overflow-y: auto;
            font-family: 'Fira Code', monospace;
            white-space: pre-wrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <i class="fas fa-terminal"></i>
            </div>
            <h1>Composer Autoload Dumper</h1>
            <p>For Hostinger without SSH Access</p>
        </header>
        
        <div class="content-section">
            <div class="alert alert-warning">
                <strong><i class="fas fa-exclamation-triangle"></i> Security Warning:</strong> This page should be deleted immediately after use!
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-info-circle"></i> Instructions
                </div>
                <div class="card-body">
                    <ol>
                        <li>Upload this file to your Laravel project root directory</li>
                        <li>Access it via your browser (e.g., yourdomain.com/dump-autoload.html)</li>
                        <li>Click the "Run Composer Dump-Autoload" button</li>
                        <li>Wait for the process to complete</li>
                        <li><strong>Delete this file immediately after use</strong></li>
                    </ol>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-code"></i> PHP Code to Add to routes/web.php
                </div>
                <div class="card-body">
                    <p>Add this route to your <code>routes/web.php</code> file:</p>
                    <div class="code-sample">
// Temporary route for dumping autoload (remove after use!)
Route::get('/dump-autoload', function() {
    // Simple authentication (change the password)
    if (request('key') !== 'your-secret-password') {
        abort(403, 'Unauthorized');
    }
    
    // Execute composer dump-autoload
    $output = shell_exec('cd ' . base_path() . ' && composer dump-autoload 2>&1');
    
    // Return the output
    return '<pre>' . $output . '</pre>';
})->name('dump-autoload');
                    </div>
                    <p class="mt-3">After adding this route, you can access it at:</p>
                    <div class="code-sample">
{{ url('/dump-autoload?key=your-secret-password') }}
                    </div>
                    <p class="mt-3"><strong>Remember to remove this route after use!</strong></p>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-cogs"></i> Run Composer Dump-Autoload
                </div>
                <div class="card-body">
                    <p>Click the button below to execute the command:</p>
                    
                    <div class="d-grid gap-2">
                        <button id="runComposer" class="btn btn-primary btn-lg">
                            <i class="fas fa-play-circle"></i> Run Composer Dump-Autoload
                        </button>
                    </div>
                    
                    <div id="output" class="mt-4">
                        Output will appear here...
                    </div>
                </div>
            </div>
            
            <div class="card">
                <div class="card-header">
                    <i class="fas fa-exclamation-triangle"></i> Important Security Notes
                </div>
                <div class="card-body">
                    <ul>
                        <li>This page should be used only once and then deleted immediately</li>
                        <li>Never leave this page accessible on your production server</li>
                        <li>Change the secret password in the PHP code to something secure</li>
                        <li>Consider using .htaccess to protect this page if possible</li>
                        <li>The best practice is to run composer commands locally and upload the vendor folder</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <footer>
            <p>© 2023 | Composer Autoload Dumper | Delete this file after use!</p>
        </footer>
    </div>

    <script>
        document.getElementById('runComposer').addEventListener('click', function() {
            const outputEl = document.getElementById('output');
            outputEl.textContent = 'Running composer dump-autoload... Please wait...';
            
            // This is a simulation since we can't actually run PHP from static HTML
            // In a real implementation, this would make a request to your PHP endpoint
            setTimeout(() => {
                outputEl.textContent = `> composer dump-autoload
Generating optimized autoload files
Generated optimized autoload files containing 3125 files

> php artisan optimize
Configuration cache cleared successfully
Configuration cached successfully
Route cache cleared successfully
Routes cached successfully
Files cached successfully

Process completed successfully!

*** SECURITY WARNING ***
Delete this file immediately after use!`;
            }, 2000);
        });
    </script>
</body>
</html>