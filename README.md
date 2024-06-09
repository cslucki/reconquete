# Reconquête! les candidats aux Européennes #
## Python pour récupérer les messages sur X ##
### Ouvrez CMD et naviguez vers votre répertoire :
` cd D:\reconquete\python `
### Créez l'environnement virtuel
` python -m venv env `
### Activez l'environnement virtuel (pour CMD)
`.\env\Scripts\activate.bat`
### Installez les bibliothèques nécessaires
`pip install selenium python-dateutil babel pyyaml`
### Exécutez votre script
`python navigate_x.py elonmusk`

En suivant ces étapes, vous devriez pouvoir créer et activer votre environnement virtuel, installer les bibliothèques nécessaires et exécuter votre script sans problème.

## Instructions génériques pour la création de fichiers YAML et HTML
### Fichier YAML

Le fichier YAML doit contenir une entrée pour chaque candidat avec les informations suivantes :
- ID du candidat
- Nom du candidat
- Adresse du compte Twitter du candidat

**Format :**
```yaml
- id: <ID_du_candidat>
  nom: "<Nom_du_candidat>"
  twitter: "<Adresse_Twitter_du_candidat>"
# Répétez cette structure pour chaque candidat
```

### Fichier HTML
Le fichier HTML doit inclure les sections suivantes pour chaque candidat, avec les balises <body> en ouverture et fermeture. Les sections peuvent varier en fonction des informations disponibles pour chaque candidat.

Exemples 
```HTML
<body>
  <h1><Nom_du_candidat> - <Profession_du_candidat></h1>

  <h2>Parcours politique</h2>
  <p><Description_du_parcours_politique_du_candidat></p>

  <h2>Positionnement politique</h2>
  <p><Description_du_positionnement_politique_du_candidat></p>

  <h2>Messages sur X</h2>
  <ol>
    <li><Description_du_message_1></li>
    <li><Description_du_message_2></li>
    <li><Description_du_message_3></li>
    <li><Description_du_message_4></li>
  </ol>
  <p><Analyse_des_messages_du_candidat></p>

  <h2>Informations personnelles</h2>
  <p><Détails_personnels_du_candidat> (optionnel)</p>

  <h2>Twitter</h2>
  <p><a href="<Adresse_Twitter_du_candidat>"><Adresse_Twitter_du_candidat></a></p>
</body>
```

### Sections typiques :
- Parcours politique
- Positionnement politique
- Messages sur X (anciennement Twitter)
- Informations personnelles (optionnel)
- Polémiques (optionnel)
- Condamnations (optionnel)
- Lien avec des organisations controversées (optionnel)
