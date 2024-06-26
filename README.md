# Reconquête! les candidats aux Européennes #
*<b>Ce script est dans la cadre du projet Fachosphère</b>*

Le projet Fachosphère du collectif LastProd vise à lutter contre la désinformation, la polarisation et la propagation de la haine en ligne. Il analyse les discours de figures controversées de l'extrême droite française, comme Papacito, et examine leur utilisation de l'intelligence artificielle et leur interprétation des faits pour alimenter leurs narratifs. Le projet inclut également des cartographies des extrêmes et suit les publications des candidats de Reconquête!.

Pour plus de détails, consultez la page officielle : *Fachosphère https://lastprod.com/fachosphere*

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

### Conversion des tweets ###
python\convert_tweets.py
pour générer ./sorted_tweets.json qui est ensuite lu par ./tweets.php


En suivant ces étapes, vous devriez pouvoir créer et activer votre environnement virtuel, installer les bibliothèques nécessaires et exécuter votre script sans problème.

## Commandes pour récupérer les tweets des candidats ##
### Méthode 1 : url = f"https://syndication.twitter.com/srv/timeline-profile/screen-name/{username}" ###
- get_x.py MarionMarechal pour générer un fichier dans ./tweets
- run_for_all.py pour toutes les entrées dans data.yaml en utilisant get_x_byID.py 
  - get_x_byID.py s'argument ainsi par run_for_all.py "get_x_byID.py 1 MarionMarechal" 
- detect_empty_files.py va détecter les fichiers vides
### Méthode 2 : on lance selenium.webdriver si les tweets ne sont pas accessibles via la méthode précédente ###
- navigate_xbyID.py 1 pour lancer une méthode alternative qui utilise un login/password
- run_for_all_empty.py va lancer detect_empty_files.py puis navigate_xbyID.py pour les tweets manquants
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
## ChatGPT pour faire les analyse ##
Voir https://chatgpt.com/g/g-Nu3SA94cQ-audit-de-la-liste-des-candidats-de-reconquete

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
