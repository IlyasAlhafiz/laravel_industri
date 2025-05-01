<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Website Artikel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Artikel</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-4">
    <header class="app-header">
        <h1 class="text-center">Artikel Pgrafi</h1>
    </header>

    <div class="row">
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h3>Kategori</h3>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item"><a href="#">Potografi</a></li>
                    <li class="list-group-item"><a href="#">Videografi</a></li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card mb-4">
                <div class="card-header">
                    <h2>Judul Artikel 1</h2>
                    <p class="text-muted">Ditulis oleh: Ariel | Kategori: Potografi</p>
                </div>
                <div class="card-body">
                    <p></p>
                    <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
                <div class="card-footer text-muted">
                    <p>13 April 2025</p>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h2>Judul Artikel 2</h2>
                    <p class="text-muted">Ditulis oleh: Karie | Kategori: Videografi</p>
                </div>
                <div class="card-body">
                    <p></p>
                    <a href="#" class="btn btn-primary">Baca Selengkapnya</a>
                </div>
                <div class="card-footer text-muted">
                    <p>14 April 2025</p>
                </div>
            </div>
        </div>
    </div>

    <div class="comments-section mt-5">
        <h3>Komentar</h3>
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Yaz</h5>
                <p class="card-text"></p>
                <footer class="blockquote-footer">Yaz | <cite title="Source Title">13 April 2025</cite></footer>
            </div>
        </div>

        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">Yoi</h5>
                <p class="card-text"></p>
                <footer class="blockquote-footer">Yoi | <cite title="Source Title">14 April 2025</cite></footer>
            </div>
        </div>
    </div>
</div>

<footer class="bg-light py-4 mt-5">
    <div class="container text-center">
        <p>&copy; 2025 Artikel Pgrafi</p>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
