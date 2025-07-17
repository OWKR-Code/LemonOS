<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lemon Developer</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Segoe UI', Inter, sans-serif;
      display: flex;
      height: 100vh;
      color: #111;
      background-color: #f2f3f5;
    }

    .sidebar {
      width: 240px;
      background-color: #ffffff;
      border-right: 1px solid #ddd;
      padding: 1rem;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      font-size: 1.4rem;
      margin-bottom: 2rem;
    }

    .nav-link {
      padding: 0.7rem 1rem;
      margin-bottom: 0.5rem;
      border-radius: 8px;
      color: #333;
      text-decoration: none;
      font-weight: 500;
      transition: background 0.2s;
    }

    .nav-link:hover,
    .nav-link.active {
      background-color: #ffe94d;
      color: #000;
    }

    .main {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
    }

    .main h1 {
      font-size: 2rem;
      margin-bottom: 1rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
      gap: 1.5rem;
    }

    .card {
      background-color: white;
      border-radius: 12px;
      padding: 1.5rem;
      box-shadow: 0 6px 12px rgba(0,0,0,0.05);
      transition: transform 0.2s;
    }

    .card:hover {
      transform: translateY(-3px);
    }

    .card h3 {
      margin-bottom: 0.5rem;
      font-size: 1.1rem;
    }

    .card p {
      font-size: 0.9rem;
      color: #555;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <h2>Developer</h2>
    <a class="nav-link active" href="#">Dashboard</a>
    <a class="nav-link" href="#">Get Started</a>
    <a class="nav-link" href="#">LemonKit SDK</a>
    <a class="nav-link" href="#">Documentation</a>
    <a class="nav-link" href="#">Your Apps</a>
    <a class="nav-link" href="#">Feedback</a>
  </div>

  <div class="main">
    <h1>Welcome to LemonOS Web Developer</h1>
    <p style="margin-bottom: 2rem; color: #666;">Learn to code for LemonOS Web and manage all your tools, SDKs, and apps right from here.</p>

    <div class="card-grid">
      <div class="card">
        <h3>📦 Install SDK</h3>
        <p>Set up the LemonKit SDK and start building your first native LemonOS app.</p>
      </div>
      <div class="card">
        <h3>🧠 Learn LemonScript</h3>
        <p>Use our beginner-friendly language based on JavaScript and build web-native desktop apps.</p>
      </div>
      <div class="card">
        <h3>📄 Documentation</h3>
        <p>Read about system APIs, window management, filesystem integration, and more.</p>
      </div>
      <div class="card">
        <h3>🚀 Build & Test</h3>
        <p>Use the in-browser terminal to compile, preview, and debug your applications.</p>
      </div>
      <div class="card">
        <h3>📁 App Manager</h3>
        <p>Manage all your uploaded, deployed, or test apps in one place.</p>
      </div>
      <div class="card">
        <h3>💬 Community</h3>
        <p>Connect with other developers, submit bugs, and share ideas to improve LemonOS Web.</p>
      </div>
    </div>
  </div>

</body>
</html>
