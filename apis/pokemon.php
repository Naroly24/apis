<?php
$title = "Información de Pokémon - Portal de APIs";
include '../includes/header.php';
?>

<div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white" style="background-color: #e3350d;">
                    <h2 class="mb-0"><i class="fas fa-gamepad"></i> Información de Pokémon</h2>
                </div>
                <div class="card-body" style="background-color: #f8f8f8;">
                    <p class="lead">Busca información detallada sobre cualquier Pokémon.</p>
                    
                    <form id="pokemonForm" class="mb-4">
                        <div class="mb-3">
                            <label for="pokemonInput" class="form-label">Ingresa el nombre o número de un Pokémon:</label>
                            <input type="text" class="form-control" id="pokemonInput" placeholder="Ej: pikachu, bulbasaur, 25, 1..." required>
                        </div>
                        <button type="submit" class="btn text-white" style="background-color: #e3350d;">
                            <i class="fas fa-search"></i> Buscar Pokémon
                        </button>
                    </form>
                    
                    <div id="result" class="mt-4"></div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header bg-info text-white">
                    <h3 class="mb-0"><i class="fas fa-info-circle"></i> Acerca de esta API</h3>
                </div>
                <div class="card-body">
                    <p>PokéAPI es una API completa que proporciona información detallada sobre el universo Pokémon.</p>
                    <p>URL de la API: <a href="https://pokeapi.co/" target="_blank">https://pokeapi.co/</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('pokemonForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const pokemon = document.getElementById('pokemonInput').value.trim().toLowerCase();
    const resultDiv = document.getElementById('result');
    
    if (pokemon === '') {
        showError(resultDiv, 'Por favor ingresa el nombre o número de un Pokémon.');
        return;
    }
    
    // Mostrar loader
    showLoader(resultDiv);
    
    // Hacer la petición a la API
    fetch(`https://pokeapi.co/api/v2/pokemon/${encodeURIComponent(pokemon)}`)
        .then(response => {
            if (!response.ok) {
                throw new Error('Pokémon no encontrado');
            }
            return response.json();
        })
        .then(data => {
            // Obtener los tipos de Pokémon
            const types = data.types.map(type => {
                const typeName = type.type.name;
                let badgeClass = 'bg-secondary';
                
                // Asignar color según el tipo
                switch(typeName) {
                    case 'normal': badgeClass = 'bg-secondary'; break;
                    case 'fire': badgeClass = 'bg-danger'; break;
                    case 'water': badgeClass = 'bg-primary'; break;
                    case 'grass': badgeClass = 'bg-success'; break;
                    case 'electric': badgeClass = 'bg-warning text-dark'; break;
                    case 'ice': badgeClass = 'bg-info text-dark'; break;
                    case 'fighting': badgeClass = 'bg-danger'; break;
                    case 'poison': badgeClass = 'bg-purple'; break;
                    case 'ground': badgeClass = 'bg-brown'; break;
                    case 'flying': badgeClass = 'bg-info'; break;
                    case 'psychic': badgeClass = 'bg-pink'; break;
                    case 'bug': badgeClass = 'bg-success'; break;
                    case 'rock': badgeClass = 'bg-brown'; break;
                    case 'ghost': badgeClass = 'bg-purple'; break;
                    case 'dark': badgeClass = 'bg-dark'; break;
                    case 'dragon': badgeClass = 'bg-indigo'; break;
                    case 'steel': badgeClass = 'bg-secondary'; break;
                    case 'fairy': badgeClass = 'bg-pink'; break;
                }
                
                return `<span class="badge ${badgeClass} me-1">${typeName.charAt(0).toUpperCase() + typeName.slice(1)}</span>`;
            }).join('');
            
            // Obtener habilidades
            const abilities = data.abilities.map(ability => {
                const abilityName = ability.ability.name.replace('-', ' ');
                return `<li>${abilityName.charAt(0).toUpperCase() + abilityName.slice(1)}${ability.is_hidden ? ' (Oculta)' : ''}</li>`;
            }).join('');
            
            // Crear el HTML del resultado
            resultDiv.innerHTML = `
                <div class="card mb-4" style="border-radius: 15px; overflow: hidden; box-shadow: 0 10px 20px rgba(0,0,0,0.1);">
                    <div class="card-header text-center text-white" style="background-color: #e3350d;">
                        <h3 class="mb-0">
                            #${data.id} ${data.name.charAt(0).toUpperCase() + data.name.slice(1)}
                        </h3>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 text-center mb-3">
                                <img src="${data.sprites.other['official-artwork'].front_default || data.sprites.front_default}" 
                                     alt="${data.name}" class="img-fluid" style="max-height: 250px;">
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <h5>Tipos:</h5>
                                    <div>${types}</div>
                                </div>
                                <div class="mb-3">
                                    <h5>Altura y Peso:</h5>
                                    <p>Altura: ${data.height / 10} m</p>
                                    <p>Peso: ${data.weight / 10} kg</p>
                                </div>
                                <div class="mb-3">
                                    <h5>Experiencia Base:</h5>
                                    <div class="progress">
                                        <div class="progress-bar bg-success" role="progressbar" 
                                             style="width: ${Math.min(100, data.base_experience / 3)}%">
                                            ${data.base_experience} XP
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Estadísticas:</h5>
                            <div class="row">
                                ${data.stats.map(stat => {
                                    const statName = stat.stat.name.replace('-', ' ');
                                    let barColor;
                                    
                                    // Asignar color según la estadística
                                    switch(stat.stat.name) {
                                        case 'hp': barColor = 'bg-success'; break;
                                        case 'attack': barColor = 'bg-danger'; break;
                                        case 'defense': barColor = 'bg-primary'; break;
                                        case 'special-attack': barColor = 'bg-warning'; break;
                                        case 'special-defense': barColor = 'bg-info'; break;
                                        case 'speed': barColor = 'bg-secondary'; break;
                                        default: barColor = 'bg-dark';
                                    }
                                    
                                    return `
                                        <div class="col-md-6 mb-2">
                                            <div class="d-flex justify-content-between mb-1">
                                                <span>${statName.charAt(0).toUpperCase() + statName.slice(1)}</span>
                                                <span>${stat.base_stat}</span>
                                            </div>
                                            <div class="progress" style="height: 10px;">
                                                <div class="progress-bar ${barColor}" role="progressbar" 
                                                     style="width: ${Math.min(100, stat.base_stat / 2)}%">
                                                </div>
                                            </div>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <h5>Habilidades:</h5>
                            <ul>
                                ${abilities}
                            </ul>
                        </div>
                    </div>
                </div>
            `;
        })
        .catch(error => {
            console.error('Error:', error);
            if (error.message === 'Pokémon no encontrado') {
                showError(resultDiv, `No se encontró ningún Pokémon con el nombre o número "${pokemon}". Verifica y vuelve a intentar.`);
            } else {
                showError(resultDiv, 'Ocurrió un error al consultar la API. Por favor intenta nuevamente.');
            }
        });
});
</script>

<?php include '../includes/footer.php'; ?>