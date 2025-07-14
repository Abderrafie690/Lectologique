const apiUrl = "https://Lectologique.alwaysdata.net/api/";

document.addEventListener("DOMContentLoaded", () => {
  fetchBooks();

  const registerBtn = document.getElementById("register-btn");
  if (registerBtn) {
    registerBtn.addEventListener("click", register);
  }
});

function fetchBooks() {
  const token = getToken();

  if (!token) {
    window.location.href = "/";
    return;
  }

  fetch(apiUrl + "bookss", {
    headers: {
      "X-AUTH-TOKEN": token,
    },
  })
    .then(response => {
      if (!response.ok) throw new Error("Erreur API");
      return response.json();
    })
    .then(data => renderBooks(data))
    .catch(error => {
      console.error("Erreur lors du chargement des livres", error);
      document.getElementById("books-table-body").innerHTML = `
        <tr><td colspan="7" class="text-center text-danger">Erreur de chargement des livres.</td></tr>
      `;
    });
}

function renderBooks(books) {
  const tbody = document.getElementById("books-table-body");
  tbody.innerHTML = "";

  books.forEach(book => {
    const row = document.createElement("tr");
    row.classList.add("text-center");

    row.innerHTML = `
      <td>${book.id}</td>
      <td>${sanitizeHtml(book.title)}</td>
      <td>${sanitizeHtml(book.auteur)}</td>
      <td>${sanitizeHtml(book.genre)}</td>
      <td>
        <span class="badge bg-${getEtatColor(book.etat)}">${sanitizeHtml(book.etat)}</span>
      </td>
      <td class="text-start">${sanitizeHtml(book.description)}</td>
      <td>
        <button class="btn btn-sm btn-outline-danger" onclick="deleteBook(${book.id})">
          <i class="bi bi-trash"></i> Supprimer
        </button>
      </td>
    `;

    tbody.appendChild(row);
  });
}

function getEtatColor(etat) {
  if (etat === "Lu") return "success";
  if (etat === "En lecture") return "warning";
  return "secondary";
}

function deleteBook(id) {
  if (!confirm("Supprimer ce livre ?")) return;

  fetch(apiUrl + "bookss/" + id, {
    method: "DELETE",
    headers: {
      "X-AUTH-TOKEN": getToken(),
    },
  })
    .then(response => {
      if (!response.ok) throw new Error("Erreur suppression");
      fetchBooks(); // Recharger après suppression
    })
    .catch(err => {
      console.error("Erreur lors de la suppression", err);
      alert("Erreur lors de la suppression.");
    });
}
