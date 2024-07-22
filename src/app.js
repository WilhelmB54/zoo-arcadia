import express from "express";
import path from "path";
import { fileURLToPath } from "url";

const __filename = fileURLToPath(import.meta.url);
const __dirname = path.dirname(__filename);

const app = express();
// Utiliser la variable d'environnement PORT ou le port 8080 par défaut
// eslint-disable-next-line no-undef
const PORT = process.env.PORT || 8080;

// Servir des fichiers statiques depuis le répertoire 'public'
app.use(express.static(path.join(__dirname, "public")));

// Route pour la page d'accueil
app.get("/", (req, res) => {
  res.sendFile(path.join(__dirname, "public", "index.php"));
});

// Gestion des erreurs 404 pour les routes non définies
app.use((req, res) => {
  res.status(404).send("Page not found");
});

// Démarrage du serveur
app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
