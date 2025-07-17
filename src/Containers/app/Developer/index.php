<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Lemon Developer</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --yellow: #ffe94d;
      --bg: #f4f4f6;
      --white: #ffffff;
      --gray: #666;
      --radius: 12px;
    }

    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
    }

    body {
      font-family: 'Inter', sans-serif;
      background-color: var(--bg);
      color: #111;
      display: flex;
      height: 100vh;
      overflow: hidden;
    }

    .sidebar {
      width: 220px;
      background-color: var(--white);
      border-right: 1px solid #ddd;
      padding: 1.5rem 1rem;
      display: flex;
      flex-direction: column;
    }

    .sidebar h2 {
      font-size: 1.3rem;
      margin-bottom: 2rem;
    }

    .nav-link {
      padding: 0.6rem 1rem;
      border-radius: var(--radius);
      margin-bottom: 0.5rem;
      text-decoration: none;
      color: #333;
      font-weight: 500;
      cursor: pointer;
      transition: 0.2s background;
    }

    .nav-link:hover,
    .nav-link.active {
      background-color: var(--yellow);
      color: #000;
    }

    .main {
      flex: 1;
      padding: 2rem;
      overflow-y: auto;
      transition: all 0.2s;
    }

    .main h1 {
      font-size: 1.8rem;
      margin-bottom: 1rem;
    }

    .main p {
      color: var(--gray);
      margin-bottom: 2rem;
    }

    .card-grid {
      display: grid;
      grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
      gap: 1.5rem;
    }

    .card {
      background-color: var(--white);
      border-radius: var(--radius);
      padding: 1.2rem;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
      transition: 0.2s transform;
    }

    .card:hover {
      transform: translateY(-3px);
    }

    .card h3 {
      font-size: 1rem;
      margin-bottom: 0.5rem;
    }

    .card p {
      font-size: 0.9rem;
      color: var(--gray);
    }

    .tab {
      display: none;
    }

    .tab.active {
      display: block;
    }
  </style>
</head>
<body>

<div class="sidebar">
  <h2>Developer</h2>
  <div class="nav-link active" data-tab="dashboard">Dashboard</div>
  <div class="nav-link" data-tab="get-started">Get Started</div>

  <div class="nav-link" data-tab="docs">Documentation</div>
  <div class="nav-link" data-tab="apps">Your Apps</div>

</div>

<div class="main">
  <div class="tab active" id="dashboard">
    <h1>Welcome to LemonOS Developer</h1>
    <p>Learn to code for LemonOS Web and manage all your tools and apps in one place.</p>

    <div class="card-grid">
      <div class="card">
        <h3>Wellcome to LemonOS</h3>
        <p>Here we will keep you updated in regards to software issues and updates. This is the platform with which
          later on you will be able to publish your own apps!</p>
      </div>

    </div>
  </div>

  <div class="tab" id="get-started">
    <h1>Get Started</h1>
    <p>Begin your journey with setup guides, dev environments and tutorials.</p>
    <div class="card-grid">
      <div class="card">
        <h3>📁 Setup Workspace</h3>
        <p>Prepare your dev environment inside LemonOS Web.</p>
      </div>
      <div class="card">
        <h3>🧪 Try Sample Apps</h3>
        <p>Run and explore sample projects to learn the structure.</p>
      </div>
    </div>
  </div>


  <div class="tab" id="docs">
    <h1>Documentation</h1>
    <p>Deep dive into the developer docs and build the future of LemonOS.</p>
  </div>

  <div class="tab" id="apps">
    <h1>Your Apps</h1>
    <p>Self signing and publishing is not available with this build. Thank you for your patience</p>
  </div>


  <script>
    const links = document.querySelectorAll('.nav-link');
    const tabs = document.querySelectorAll('.tab');

    links.forEach(link => {
      link.addEventListener('click', () => {
        // Update active tab in sidebar
        links.forEach(l => l.classList.remove('active'));
        link.classList.add('active');

        // Show correct tab content
        tabs.forEach(tab => tab.classList.remove('active'));
        const tabId = link.getAttribute('data-tab');
        document.getElementById(tabId).classList.add('active');
      });
    });
  </script>

</body>
</html>