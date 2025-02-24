<?php
require_once '../configuration/config.php';
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche animaux arcadia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">  
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>


<!-- START NAV -->
<nav class="navbar navbar-expand-lg bg-body-tertiary p-3" id="menu">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <span class="text-success fs-5 fw-bold">Arcadia</span>
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="../index.php">Accueil</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" aria-current="page" href="animaux.php">Nos Animaux</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="habitats_page.php">Nos Habitats</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="page_services.php">Nos Services</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
                <button class="btn btn-outline-success" type="submit" ><a href="connexion.php" >connexion</a></button>
            </form>
          </div>
        </div>
      </nav>

      <!-- END NAV -->


      <!-- START BARRE DE RECHERCHE -->

      <div class="container mt-5">
        <input type="text" id="searchInput" class="form-control" placeholder="Rechercher par race...">
        <button class="btn btn-success mt-2" onclick="search()">Rechercher</button>
        <div id="searchResults" class="row mt-3 d-flex justify-content-around"></div>
    </div>
    
    <!-- END BARRE DE RECHERCHE -->

<!-- 
    START SCRIPT AFFICHAGE ANIMAUX -->
     <script>
    function search() {
    var input = document.getElementById('searchInput').value.toLowerCase();
    var results = document.getElementById('searchResults');
    results.innerHTML = '';

    fetch('recherche_animaux.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'query=' + encodeURIComponent(input)
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok ' + response.statusText);
        }
        return response.json();
    })
    .then(data => {
        if (data.length > 0) {
            data.forEach(function(item) {
                var div = document.createElement('div');
                div.classList.add('col-md-3');
                div.style.maxWidth = '200px';
                div.style.marginBottom = '20px';
                div.innerHTML = `
                    <div class="card mb-5" style="border: 1px solid #ddd; border-xradius: 5p;">
                        <img src="data:image/jpeg;base64,${item.image_data}" class="card-img-top" alt="${item.prenom}" style="border: 2px solid #28a745; width: 100%; height: 100px;">
                        <div class="card-body" style="padding: 15px;">
                            <h5 class="card-title" style="font-size: 1.25rem; font-weight: bold;">${item.prenom}</h5>
                            <p class="card-race" style="font-size: 1rem; color: #6c757d;">Race : ${item.label}</p>
                            <a href="detail_animal.php?animal_id=${item.animal_id}" class="btn btn-success" style="background-color: #28a745; color: white;">Voir la fiche</a>
                        </div>
                    </div>
                `;
                results.appendChild(div);
            });
        } else {
            results.innerHTML = 'Aucun résultat trouvé';
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        results.innerHTML = 'Une erreur est survenue lors de la recherche.';
    });
}

document.addEventListener('DOMContentLoaded', function() {
    search();
});
</script>

<!-- START FOOTER -->

      <footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <section class="d-flex justify-content-center justify-content-lg-around p-4 border-bottom">
    
     
      <div class="me-5 d-none d-lg-block text-success ">
        <span>Retrouvez-nous sur les reseaux sociaux:</span>
      </div>
    
      <div>
        <a href="" class="me-4 text-success">
          <i class="fab fa-facebook-f"></i>
        </a>
        <a href="" class="me-4 text-success">
          <i class="fab fa-twitter"></i>
        </a>
        <a href="" class="me-4 text-success">
          <i class="fab fa-instagram"></i>
        </a>
      </div>
      
    </section>
 

  <!-- START LINKS -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold mb-4 text-success">
            <i class="fas fa-gem me-3 text-success"></i>Arcadia
          </h6>
          <p>
            Un lieu où la nature et la durabilité sont au cœur de tout.
          </p>
        </div>
      
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-success">
            Notre Zoo
          </h6>
          <p>
            <a href="animaux.php" class="text-success">Animaux</a>
          </p>
          <p>
            <a href="habitats_page.php" class="text-success">Habitats</a>
          </p>
          <p>
            <a href="#!" class="text-success">Rejoignez-nous</a>
          </p>
      
        </div>
  
        <div class="col-md-3 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-success">
           Services
          </h6>
          <p>
            <a href="#!" class="text-success">Billeterie</a>
          </p>
          <p>
            <a href="page_services.php" class="text-success">Restauration</a>
          </p>
          <p>
            <a href="page_services.php" class="text-success">Visite du zoo avec un guide</a>
          </p>
          <p>
            <a href="page_services.php" class="text-success">Visite du zoo en petit train</a>
          </p>
        </div>
    
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4 text-success">Contact</h6>
          <p><i class="fas fa-home me-3 text-success"></i> Forêt de Brocéliande, 35380 Paimpont</p>
          <p>
            <i class="fas fa-envelope me-3 text-success"></i>
            info@arcadia.com
          </p> 
          <p><i class="fas fa-phone me-3 text-success"></i> + 01 234 567 88</p>
          <p><i class="fas fa-print me-3 text-success"></i> + 01 234 567 89</p>
        </div>
      </div>
    </div>
  </section>

  <!-- COPYRIGHT -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class=" fw-bold text-success" href="#">ARCADIA</a>
  </div> 
</footer>

      
      <!-- SCRIPT -->
    
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
      <script src="https://unpkg.com/typewriter-effect@latest/dist/core.js"></script>
    

</body>
</html>
