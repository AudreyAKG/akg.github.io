<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$nomUtilisateur = "root";
$motDePasse = "";
$nomBaseDeDonnees = "formation";

try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$formation", $nomUtilisateur, $motDePasse);
    // Activez les exceptions PDO pour les erreurs de requête
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
// Récupérez les données du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $emailOuTelephone = $_POST["emailOuTelephone"];
    $motDePasse = $_POST["motDePasse"];

    // Vous devez effectuer ici des vérifications de sécurité et de validation.

    // Préparez et exécutez la requête d'insertion
    $sql = "INSERT INTO users (email_ou_telephone, mot_de_passe) VALUES (:emailOuTelephone, :motDePasse)";
    
    $requete = $bdd->prepare($sql);

    $requete->bindParam(':emailOuTelephone', $emailOuTelephone);
    $requete->bindParam(':motDePasse', $motDePasse);

    try {
        $requete->execute();
        echo "Enregistrement réussi.";
    } catch (PDOException $e) {
        echo "Erreur lors de l'enregistrement : " . $e->getMessage();
    }
}
?>
