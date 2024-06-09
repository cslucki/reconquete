# Reconquête! les candidats aux Européennes #
## Python pour récupérer les messages sur X ##
### Ouvrez CMD et naviguez vers votre répertoire :
` cd D:\reconquete\python `
### Créez l'environnement virtuel
` python -m venv env `
### Activez l'environnement virtuel (pour CMD)
`.\env\Scripts\activate.bat`
### Installez les bibliothèques nécessaires
`pip install selenium python-dateutil babel`
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

============
python get_x.py MarionMarechal
python get_x.py G_Peltier
python get_x.py knafo_sarah
python get_x.py NicolasBay_
python get_x.py LaurenceTrochu
python get_x.py stanislasrig
python get_x.py _AgnesMarion
python get_x.py JeanMessiha
python get_x.py SophieGrech13
python get_x.py P_Vardon
python get_x.py EveFroger
python get_x.py damienrieu
python get_x.py SeverineDuminy
python get_x.py lansade
python get_x.py FontEmmy
python get_x.py philippecuigna1
python get_x.py ChiabertoMarine
python get_x.py franck_manogil
# Elodie Weber n'a pas de compte Twitter, donc cette ligne est omise
python get_x.py HilaireBouye
python get_x.py E_Louvel
python get_x.py olivierlecoq
python get_x.py LucyMotherOf4
python get_x.py arno_humbert
python get_x.py Pozzo_diBorgo
python get_x.py FGaillard21
python get_x.py Paola_Plantier
python get_x.py S_Blanchon
python get_x.py ClmentSabine
python get_x.py Franckchc1
python get_x.py WendyLonchampt
python get_x.py BuardSbastien1
python get_x.py GiraudCorinne3
python get_x.py david_meyer2022
python get_x.py IsabelleGilbert
python get_x.py Dany_AEZ
python get_x.py DelatreSandrin1
python get_x.py sergelevy770
python get_x.py BallerandN
python get_x.py XavierFourboul
python get_x.py LamarqueIsabel2
python get_x.py camusantoine199
python get_x.py AnnickPllt
python get_x.py AZYZECK
python get_x.py Fleur_Z74
# Maurice Portiche n'a pas de compte Twitter, donc cette ligne est omise
python get_x.py PascaleDeutsch
python get_x.py TorrensCedric
# Fabienne Marquet n'a pas de compte Twitter, donc cette ligne est omise
python get_x.py MarcTaulelle30
python get_x.py MaylisPerrot
python get_x.py AntoineBaudino
python get_x.py SabineLeger
python get_x.py HerbreteauRaym2
python get_x.py DomiPiussan
python get_x.py OlivierCleland
python get_x.py LeilaMarieR
python get_x.py ImbertGuyEric
python get_x.py corinneberardo
python get_x.py JeanMoucheboeuf
python get_x.py CadenelMyriam
python get_x.py Pr1cedechezloub
python get_x.py ana_pinson
python get_x.py EricLaqua
python get_x.py anh_nhu23003
python get_x.py JLCdeB
python get_x.py khart06
python get_x.py ArnaudChapon
python get_x.py Laure_Pellier
python get_x.py florenthammer
python get_x.py HubertCaro26011
# Alain Smith n'a pas de compte Twitter, donc cette ligne est omise
python get_x.py GauerClaire
python get_x.py Lamberti_JM
python get_x.py FannyJudek
python get_x.py CompteTwitter
python get_x.py BenouadahSimone
python get_x.py YannBompard
# Ornella Evangelista n'a pas de compte Twitter, donc cette ligne est omise
python get_x.py ZemmourEric
# Evelyne Reybert n'a pas de compte Twitter, donc cette ligne est omise
