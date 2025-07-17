<?php
session_start();
if (!isset($_SESSION['logged_in'])) {
    header('Location: /LemonOS/public/login/login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>macOS Desktop</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        }

        body {
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1750099255888-91d5386e833c?q=80&w=2370&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D') center/cover no-repeat fixed;
            overflow: hidden;
        }

        .menubar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 25px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            display: flex;
            align-items: center;
            padding: 0 10px;
            color: white;
            z-index: 1000;
        }

        .apple-logo {
            width: 15px;
            height: 15px;
            margin-right: 20px;
            cursor: pointer;
        }

        .dock {
            position: fixed;
            bottom: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 5px;
            border-radius: 16px;
            display: flex;
            gap: 10px;
        }

        .dock-icon {
            width: 50px;
            height: 50px;
            border-radius: 10px;
            cursor: pointer;
            transition: transform 0.2s;
        }

        .dock-icon:hover {
            transform: scale(1.2);
        }

        .desktop-icons {
            padding: 20px;
            display: grid;
            grid-template-columns: repeat(auto-fill, 100px);
            gap: 20px;
            margin-top: 30px;
        }

        .desktop-icon {
            width: 80px;
            text-align: center;
            color: white;
            cursor: pointer;
        }

        .desktop-icon img {
            width: 50px;
            height: 50px;
            margin-bottom: 5px;
        }

        .desktop-icon p {
            font-size: 12px;
            text-shadow: 0 1px 3px rgba(0, 0, 0, 0.6);
        }

        .dev-icon {
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            padding: 10px;
            text-align: center;
            font-size: 12px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
    </style>
</head>
<body>
<div class="menubar">

    <span>Beta 0.9.5</span>
</div>

<div class="desktop-icons">
    <div class="desktop-icon">

    </div>
</div>

<div class="dock">

</div>

<script>
    // Load app configuration
    const loadAppConfig = async () => {
        try {
            const response = await fetch('../../src/Containers/app_config.json');
            return await response.json();
        } catch (error) {
            console.error('Error loading app config:', error);
            return {Apps: []};
        }
    };

    // Create dock icon
    const createDockIcon = (app) => {
        const icon = document.createElement('div');
        icon.className = 'dock-icon';

        if (app.development) {
            icon.innerHTML = `
                <div class="dev-icon">${app.displayName}</div>
            `;
        } else {
            icon.innerHTML = `
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBmaWxsPSJ3aGl0ZSI+PHBhdGggZD0iTTQ0OCAzNjBWMjRIMTI4djMzNkgzMnY4MGg0NDh2LTgwem0tMzUyIDBoLTMydi0zMmgzMnptMzIwIDBoLTI4OHYtMzJoMjg4em0wLTY0aC0zMjBWNTZoMzIweiIvPjwvc3ZnPg==" alt="${app.displayName}">
            `;
        }

        icon.onclick = () => launchApp(app);
        return icon;
    };

    // Create desktop icon
    const createDesktopIcon = (app) => {
        const icon = document.createElement('div');
        icon.className = 'desktop-icon';

        if (app.development) {
            icon.innerHTML = `
                <div class="dev-icon">${app.displayName}</div>
                <p>${app.displayName}</p>
            `;
        } else {
            icon.innerHTML = `
                <img src="data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI1MTIiIGhlaWdodD0iNTEyIiBmaWxsPSJ3aGl0ZSI+PHBhdGggZD0iTTQ0OCAzNjBWMjRIMTI4djMzNkgzMnY4MGg0NDh2LTgwem0tMzUyIDBoLTMydi0zMmgzMnptMzIwIDBoLTI4OHYtMzJoMjg4em0wLTY0aC0zMjBWNTZoMzIweiIvPjwvc3ZnPg==" alt="${app.displayName}">
                <p>${app.displayName}</p>
            `;
        }

        icon.onclick = () => launchApp(app);
        return icon;
    };

    // Launch app function
    const launchApp = (app) => {
        if (app.development && window.location.hostname !== 'localhost') {
            console.log('Development app can only run on localhost');
            return;
        }

        if (!app.path) {
            console.error(`No path defined for app: ${app.displayName}`);
            return;
        }

        try {
            // Construct full path relative to root
            const rootPath = '/LemonOS';
            const fullPath = `${rootPath}${app.path}`;
            window.location.href = fullPath;
        } catch (error) {
            console.error(`Error launching ${app.displayName}:`, error);
        }
    };

    // Initialize app icons
    const initializeApps = async () => {
        const dock = document.querySelector('.dock');
        const desktop = document.querySelector('.desktop-icons');

        const config = await loadAppConfig();

        config.Apps.forEach(app => {
            if (app.dock) {
                dock.appendChild(createDockIcon(app));
            }
            if (app.desktop) {
                desktop.appendChild(createDesktopIcon(app));
            }
        });
    };

    // Initialize when DOM is ready
    document.addEventListener('DOMContentLoaded', initializeApps);
</script>
</body>
</html>