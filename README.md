# mediatek-remix

Suite à une fausse manip, j'ai perdu mon README initial donc je le réecris!
les 2 derniers commits ont était fait pour revenir à un état stable.

#Installation en local uniquement:

  1. S'assurer que PHP, MySQL , symfony , composer soient bien installé.
  
  2.Git clone adresse_du_repo dans fichier au choix
  
  3.COnfiguration du fichier .env décommentez la ligne SQL , 
  renseigner nom pour se connecter(ROOT en génèral) + mot de passe(si besoin) + port
  
  4. Lancer la commande composer update(optionnel) permet de mettre toutes le dépendances nécessaire si composer déja installé
  
  5. Effectuer les migrations commande: doctrine:migrations:migrate
  
  6.Symfony serve pour lancez le serveur RDV à l'adresse indiquée dans le terminal
  
  
#Application 

  SECURITE:
    
    LEs mots de passe sont hashés dans la BDD
    3 ROLESd'utilisateur:
      ADMIN > AUTHOR > USER (par défaut)
      
      Seul un ADMIN peut ATTRIBUER UN ROLE.
      
      AUTHOR et ADMIN:
      Création et modification de Livres 
      L'affectation d'un livre à un utilisateur
      Vue sur le utilisateurs
      
      USER:
      Pour l'instant la vue est interdite car elle n'est pas restyreinte à l'utilisateur
  FONCTIONNALITES:
  
    INSCRIPTION:
      -Formulaire avec confirmation du mot de passe à 2 reprises
    CONNEXION:
      -A l'aide des informations renseignées connectez-vous
      -Seul les liens en dessous du texte sont opérationnels
  
    ACCES au CATALOGUE
      -Possibilité de rechercher par titre
      -Possibilité de recherhcer par auteur et de voir les livres associés
  
  

