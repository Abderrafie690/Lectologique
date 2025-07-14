import Route from "./Route.js";

export const websiteName = "Lectologique";

export const allRoutes = [
  new Route("/", "Accueil", "views/pages/home.html", []),
  new Route("/galerie", "Galerie", "views/pages/general/galerie.html", []),
  new Route("/allResa", "Vos réservations", "views/reservations/allResa.html", ["client"]),
  new Route("/reserver", "réserver", "views/pages/reserver.html", ["client"]),
  new Route("/dashboard", "Tableau de bord", "views/pages/dashboard.html", ["admin"] ),
  new Route("/profile", "Mon compte", "views/pages/auth/profile.html", ["client", "admin"]),
  new Route("/edit-password", "Modifier mot de passe", "views/pages/auth/edit_password.html", ["client", "admin"]),
  new Route("/mes-livres", "mes livres", "views/pages/admin/mes-livres.html", ["client", "admin"]),
 
  new Route("/login", "Connexion", "views/pages/auth/login.html", ["disconnected"], "js/auth/login.js"),
  new Route("/register", "Inscription", "views/pages/auth/register.html",["disconnected"],"js/auth/register.js"),
  new Route("/add-book", "Ajouter un livre", "views/pages/add_book.html", "js/book/add_book.js"),
  new Route("/edit-book", "Modifier un livre", "views/pages/edit_book.html", "js/book/edit_book.js"),
   new Route("/gestion-livres", "Gestion des livres", "/views/pages/admin/gestion-livres.html", ["admin"], "/js/auth/admin/gestion-livres.js"),
  
];
