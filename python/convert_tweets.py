import os
import json
import yaml
from datetime import datetime

# Dictionnaire pour mapper les mois français aux numéros de mois
mois_francais = {
    "janv.": "01",
    "févr.": "02",
    "mars": "03",
    "avr.": "04",
    "mai": "05",
    "juin": "06",
    "juil.": "07",
    "août": "08",
    "sept.": "09",
    "oct.": "10",
    "nov.": "11",
    "déc.": "12"
}

# Fonction pour convertir une date en français en format ISO
def convertir_date_francaise(date_str):
    for mois, numero in mois_francais.items():
        if mois in date_str:
            date_str = date_str.replace(mois, numero)
            break
    return datetime.strptime(date_str, '%d %m %Y, %H:%M:%S')

# Définir le répertoire contenant les fichiers de tweets
tweets_directory = r'D:\reconquete\tweets'
output_file = r'D:\reconquete\sorted_tweets.json'
data_yaml_file = r'D:\reconquete\data.yaml'

# Lire les données des candidats depuis data.yaml
with open(data_yaml_file, 'r', encoding='utf-8') as yaml_file:
    candidates_data = yaml.safe_load(yaml_file)

# Créer un dictionnaire pour accéder rapidement aux noms des candidats par leur ID
candidates = {str(candidate['id']): candidate['nom'] for candidate in candidates_data}

# Fonction pour convertir un fichier de tweets en JSON
def collect_tweets(file_path, candidate_id):
    tweets = []
    with open(file_path, 'r', encoding='utf-8') as file:
        lines = file.readlines()
        tweet = {}
        for line in lines:
            if line.startswith("Date:"):
                date_str = line[len("Date:"):].strip()
                try:
                    tweet['date'] = convertir_date_francaise(date_str)
                except ValueError as e:
                    print(f"Erreur de parsing de la date dans le fichier {file_path}: {e}")
                    continue
            elif line.startswith("Tweet:"):
                tweet['tweet'] = line[len("Tweet:"):].strip()
                tweet['candidate_id'] = candidate_id
                tweet['candidate_name'] = candidates.get(candidate_id, 'Inconnu')
                tweets.append(tweet)
                tweet = {}
    return tweets

# Collecter tous les tweets
all_tweets = []
for filename in os.listdir(tweets_directory):
    if filename.endswith(".txt"):
        file_path = os.path.join(tweets_directory, filename)
        candidate_id = os.path.splitext(filename)[0]
        all_tweets.extend(collect_tweets(file_path, candidate_id))

# Trier les tweets par date
all_tweets_sorted = sorted(all_tweets, key=lambda x: x['date'])

# Convertir les dates en format d-m-Y H:i:s pour le JSON
for tweet in all_tweets_sorted:
    tweet['date'] = tweet['date'].strftime('%d-%m-%Y %H:%M:%S')

# Sauvegarder les tweets triés dans un fichier JSON
with open(output_file, 'w', encoding='utf-8') as json_file:
    json.dump(all_tweets_sorted, json_file, ensure_ascii=False, indent=4)

print(f"Les tweets ont été triés et sauvegardés dans {output_file}")