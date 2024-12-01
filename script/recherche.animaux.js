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
                
                div.style.maxWidth = '100px';
                div.style.marginBottom = '20px';
                div.innerHTML = `
                    <div class="card mb-5" style="border: 1px solid #ddd; border-radius: 5px;">
                        <img src="data:image/jpeg;base64,${item.image_data}" class="card-img-top" alt="${item.prenom}" style="border: 2px solid #28a745; border-radius: 50%; width: 100%; height: auto;">
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