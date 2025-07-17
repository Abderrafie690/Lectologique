const tokenCookieName = "accesstoken";
const roleCookieName = "role";
const apiUrl = "http://localhost/lectologique/api/";



  const logoutBtn = document.getElementById("logout-btn");
  if (logoutBtn) {
    logoutBtn.addEventListener("click", logout);
  }

  showAndHideElementsForRoles();

  function setCookie(name, value, days) {
  const expires = new Date(Date.now() + days * 864e5).toUTCString();
  document.cookie = name + "=" + encodeURIComponent(value) + "; expires=" + expires + "; path=/";
}



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
  return getToken() !== null && getToken() !== undefined && getToken() !== "";
}

// --- SIGNOUT ---
function logout() {
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

  const allElementsToEdit = document.querySelectorAll('[data-show]');
  allElementsToEdit.forEach(element => {
    switch (element.dataset.show) {
      case 'disconnected':
        element.classList.toggle("d-none", userConnected);
        break;
      case 'connected':
        element.classList.toggle("d-none", !userConnected);
        break;
      case 'admin':
        element.classList.toggle("d-none", !userConnected || role !== "admin");
        break;
      case 'client':
        element.classList.toggle("d-none", !userConnected || role !== "client");
        break;
    }
  });
}

/*
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
*/