<!doctype html>
<html lang="en" class="h-100">
<head>
  <meta charset="utf-8">
  <title><?= esc($title ?? 'Flight FE') ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="/airplane.svg" type="image/svg+xml">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://unpkg.com/htmx.org@2.0.2"></script>
</head>
<body class="d-flex flex-column h-100">

<header>
  <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom shadow-sm">
    <div class="container">
      <a class="navbar-brand d-flex align-items-center" href="/">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-airplane-fill me-2 text-primary" viewBox="0 0 16 16">
          <path d="M6.428 1.151C6.708.591 7.213 0 8 0s1.292.592 1.572 1.151C9.861 1.73 10 2.431 10 3v3.691l5.17 2.585a1.5 1.5 0 0 1 .83 1.342V12a.5.5 0 0 1-.582.493l-5.507-.918-.375 2.253 1.318 1.318A.5.5 0 0 1 10.5 16h-5a.5.5 0 0 1-.354-.854l1.319-1.318-.375-2.253-5.507.918A.5.5 0 0 1 0 12v-1.382a1.5 1.5 0 0 1 .83-1.342L6 6.691V3c0-.568.14-1.271.428-1.849Z"/>
        </svg>
        <span class="fw-bold">FlightBooker</span>
      </a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="/admin/bookings">Manage Bookings</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<main class="flex-shrink-0 bg-light">
  <div class="container py-4">
    <?php if (session()->getFlashdata('error')): ?>
      <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('success')): ?>
      <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>

    <?= $content ?? '' ?>
  </div>
</main>

<footer class="footer mt-auto py-3 bg-white border-top">
  <div class="container text-center">
    <span class="text-muted">&copy; <?= date('Y') ?> FlightBooker. All rights reserved.</span>
  </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="/js/app.js"></script>
</body>
</html>
