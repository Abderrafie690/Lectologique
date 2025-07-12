import Route from "./Route.js";

export const websiteName = "Lectologique";

export const allRoutes = [
  new Route("/", "Accueil", "views/pages/home.html", ),

  new Route("/galerie", "Galerie", "views/pages/general/galerie.html", ""),
 new Route("/allResa", "reservations", "views/reservations/allResa.html", ""),
 new Route("/reserver", "réservations", "views/pages/reserver.html", ""),
  new Route("/dashboard", "Tableau de bord", "views/pages/dashboard.html", "js/auth/dashboard.js"),
  new Route("/profile", "Mon compte", "views/pages/auth/profile.html", "js/auth/profile.js"),
  new Route("/edit-password", "Modifier mot de passe", "views/pages/auth/edit_password.html", "js/auth/edit_password.js"),
  new Route("/logout", "Déconnexion", "views/pages/auth/logout.html", "js/auth/logout.js"),
  new Route("/login", "Connexion", "views/pages/auth/login.html", "js/auth/login.js"),
  new Route("/register", "Inscription", "views/pages/auth/register.html", "js/auth/register.js"),
  new Route("/add-book", "Ajouter un livre", "views/pages/add_book.html", "js/book/add_book.js"),
  new Route("/edit-book", "Modifier un livre", "views/pages/edit_book.html", "js/book/edit_book.js"),
  new Route("/404", "Introuvable", "views/pages/general/404.html", "")
];
