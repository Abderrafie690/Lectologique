// js/mes-livres.js
document.addEventListener('DOMContentLoaded', async () => {
    const app = document.getElementById('app');
    app.innerHTML = '<p class="text-center">Chargement des livres...</p>';

    try {
        const res = await fetch('/api/books', {
            method: 'GET',
            credentials: 'include',
            headers: {
                'Accept': 'application/json'
            }
        });

        if (res.status === 401) {
            window.location.href = '/login.html';
            return;
        }

        const books = await res.json();

        let html = `
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold text-primary">📚 Mes livres</h2>
          <a href="/add-book" class="btn btn-success">
  <i class="bi bi-plus-circle me-1"></i> Ajouter un nouveau livre
</a>

        </div>
        <div class="row row-cols-1 row-cols-md-3 g-4">
        `;

        if (books.length === 0) {
            html += `<p class="text-center text-muted">Vous n'avez pas encore de livres enregistrés.</p>`;
        } else {
            books.forEach(book => {
                const badgeClass = book.etat === 'Lu' ? 'success'
                                 : book.etat === 'En lecture' ? 'warning text-dark'
                                 : 'secondary';

                html += `
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-4">
                        ${
                          book.cover_path
                            ? `<img src="${book.cover_path}" class="card-img-top rounded-top-4" alt="Couverture du livre">`
                            : `<div class="d-flex align-items-center justify-content-center bg-secondary text-white rounded-top-4" style="height: 250px;">
                                 <span class="fs-4">📚 Sans image</span>
                               </div>`
                        }
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary fw-bold mb-3">${book.title}</h5>
                            <ul class="list-unstyled small text-muted">
                                <li><i class="bi bi-person-fill text-primary me-1"></i> <strong>Auteur:</strong> ${book.auteur}</li>
                                <li><i class="bi bi-tags-fill text-success me-1"></i> <strong>Genre:</strong> ${book.genre}</li>
                                <li>
                                    <i class="bi bi-bookmark-check-fill text-warning me-1"></i> 
                                    <strong>État:</strong>
                                    <span class="badge bg-${badgeClass}">${book.etat}</span>
                                </li>
                            </ul>
                            ${book.description ? `<p class="text-muted mt-2 small">${book.description}</p>` : ''}
                        </div>
                        <div class="card-footer d-flex justify-content-between flex-wrap gap-2 bg-light">
                            <a href="/livre.html?id=${book.id}" class="btn btn-sm btn-outline-secondary">🔍 Voir</a>
                            <a href="/editer-livre.html?id=${book.id}" class="btn btn-sm btn-primary">✏️ Éditer</a>
                            <a href="/supprimer-livre.html?id=${book.id}" class="btn btn-sm btn-danger" onclick="return confirm('Êtes-vous sûr ?')">🗑️ Supprimer</a>
                        </div>
                    </div>
                </div>
                `;
            });
        }

        html += `</div>`;
        app.innerHTML = html;

    } catch (err) {
        app.innerHTML = `<p class="text-danger">Erreur lors du chargement : ${err.message}</p>`;
    }
});
