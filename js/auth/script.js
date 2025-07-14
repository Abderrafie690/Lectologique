// script.js
const tokenCookieName = "accesstoken";
const registertBtn = document.getElementById("register-btn");
const roleCookieName = "role";
//const apiUrl = "http://localhost/lectologique/api/"; // ⚠️ Cambia según tu entorno

//document.addEventListener('DOMContentLoaded', () => {
  //const logoutBtn = document.getElementById("logout-btn");
  //if (logoutBtn) {
    registertBtn.addEventListener("click", register);
  //}
  function getRole(){
    return getCookie(roleCookieName);
  }

  //showAndHideElementsForRoles(); // Aplica visibilidad según roles
//});

// --- TOKEN & ROLE ---
function setToken(token) {
  setCookie(tokenCookieName, token, 7);
}
function getToken() {
  return getCookie(tokenCookieName);
}

function isConnected() {
  if(getToken() == null || getToken == undefined){
    return false;
  }
  else{
    return true;
  }
}


// --- SIGNOUT ---
function register() {
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

  let allElementsToEdit = document.querySelectorAll('[data-show]');
  allElementsToEdit.forEach(element => {
    switch (element.dataset.show) {
      case 'disconnected':
        if (userConnected) {
          element.classList.add("d-none");
        } else {
          element.classList.remove("d-none");
        }
        break;

      case 'connected':
        if (!userConnected) {
          element.classList.add("d-none");
        } else {
          element.classList.remove("d-none");
        }
        break;

      case 'admin':
        if (!userConnected || role !== "admin") {
          element.classList.add("d-none");
        } else {
          element.classList.remove("d-none");
        }
        break;

      case 'client':
        if (!userConnected || role !== "client") {
          element.classList.add("d-none");
        } else {
          element.classList.remove("d-none");
        }
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