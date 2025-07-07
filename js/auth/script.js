// script.js
const tokenCookieName = "accesstoken";
const roleCookieName = "role";
const apiUrl = "http://localhost/lectologique/api/"; // ⚠️ Cambia según tu entorno

document.addEventListener('DOMContentLoaded', () => {
  const signoutBtn = document.getElementById("signout-btn");
  if (signoutBtn) {
    signoutBtn.addEventListener("click", signout);
  }

  showAndHideElementsForRoles(); // Aplica visibilidad según roles
});

// --- TOKEN & ROLE ---
function setToken(token) {
  setCookie(tokenCookieName, token, 7);
}
function getToken() {
  return getCookie(tokenCookieName);
}
function getRole() {
  return getCookie(roleCookieName);
}
function isConnected() {
  return !(getToken() == null || getToken === undefined);
}

// --- SIGNOUT ---
function signout() {
  eraseCookie(tokenCookieName);
  eraseCookie(roleCookieName);
  window.location.reload();
}

// --- COOKIES ---
function setCookie(name, value, days) {
  let expires = "";
  if (days) {
    const date = new Date();
    date.setTime(date.getTime() + days * 24 * 60 * 60 * 1000);
    expires = "; expires=" + date.toUTCString();
  }
  document.cookie = name + "=" + (value || "") + expires + "; path=/";
}
function getCookie(name) {
  const nameEQ = name + "=";
  const ca = document.cookie.split(';');
  for (const c of ca) {
    let trimmed = c.trim();
    if (trimmed.startsWith(nameEQ)) {
      return trimmed.substring(nameEQ.length);
    }
  }
  return null;
}
function eraseCookie(name) {
  document.cookie = name + "=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;";
}

// --- VISIBILIDAD POR ROL ---
function showAndHideElementsForRoles() {
  const userConnected = isConnected();
  const role = getRole();

  document.querySelectorAll('[data-show]').forEach((el) => {
    switch (el.dataset.show) {
      case 'disconnected':
        if (userConnected) el.classList.add("d-none");
        break;
      case 'connected':
        if (!userConnected) el.classList.add("d-none");
        break;
      case 'admin':
        if (!userConnected || role !== "ROLE_ADMIN") el.classList.add("d-none");
        break;
      case 'client':
        if (!userConnected || role !== "ROLE_CLIENT") el.classList.add("d-none");
        break;
    }
  });
}

// --- SANITIZAR TEXTO ---
function sanitizeHtml(text) {
  const temp = document.createElement('div');
  temp.textContent = text;
  return temp.innerHTML;
}

// --- OBTENER DATOS DE USUARIO ---
function getInfosUser() {
  const headers = new Headers();
  headers.append("X-AUTH-TOKEN", getToken());

  fetch(apiUrl + "account/me", {
    method: "GET",
    headers: headers
  })
    .then((res) => res.ok ? res.json() : Promise.reject("Non connecté"))
    .then((user) => {
      console.log("Utilisateur:", user);
    })
    .catch((err) => {
      console.error("Erreur utilisateur:", err);
    });
}
