import Route from "./Route.js";
import { allRoutes, websiteName } from "./allRoutes.js";

// 🔹 Route 404 par défaut
const route404 = new Route("404", "Page introuvable", "views/pages/general/404.html", "");

// 🔹 Trouve la route correspondant à l’URL
const getRouteByUrl = (url) => {
  const route = allRoutes.find(route => route.url === url);
  return route ?? route404;
};

// 🔹 Charge dynamiquement le contenu dans #main-page
const LoadContentPage = async () => {
  const path = window.location.pathname;
  const actualRoute = getRouteByUrl(path);

  try {
    const html = await fetch(actualRoute.pathHtml).then(res => res.text());
    document.getElementById("main-page").innerHTML = html;

    // 📄 Chargement JS spécifique à la page
    if (actualRoute.pathJS && actualRoute.pathJS !== "") {
      const scriptTag = document.createElement("script");
      scriptTag.type = "text/javascript";
      scriptTag.src = actualRoute.pathJS;
      document.body.appendChild(scriptTag);
    }

    // 🧠 Mise à jour du titre de la page
    document.title = `${actualRoute.title} - ${websiteName}`;

    // 👁️ Mise à jour visibilité selon rôles (si existe cette fonction)
    if (typeof showAndHideElementsForRoles === "function") {
      showAndHideElementsForRoles();
    }

  } catch (error) {
    console.error("Erreur de chargement de la page :", error);
    document.getElementById("main-page").innerHTML = "<p>Erreur de chargement.</p>";
  }
};

// 🔹 Gestion du clic sur un lien
const routeEvent = (event) => {
  event = event || window.event;
  event.preventDefault();
  window.history.pushState({}, "", event.target.href);
  LoadContentPage();
};

// 🔹 Historique (bouton retour)
window.onpopstate = LoadContentPage;

// 🔹 Liens avec data-link
document.addEventListener("click", (e) => {
  if (e.target.matches("[data-link]")) {
    e.preventDefault();
    window.route(e);
  }
});

// 🔹 Rendu initial
window.route = routeEvent;
LoadContentPage();
