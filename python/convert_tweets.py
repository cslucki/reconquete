import os
import json
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
    return datetime.strptime(date_str, '%d %m %Y, %H:%M:%S').isoformat()

# Définir le répertoire contenant les fichiers de tweets
tweets_directory = r'D:\reconquete\tweets'
output_directory = r'D:\reconquete\converted_tweets'
os.makedirs(output_directory, exist_ok=True)

# Fonction pour convertir un fichier de tweets en JSON
def convert_tweet_file_to_json(file_path, output_path):
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
                tweets.append(tweet)
                tweet = {}
    
    with open(output_path, 'w', encoding='utf-8') as json_file:
        json.dump(tweets, json_file, ensure_ascii=False, indent=4)

# Parcourir tous les fichiers dans le répertoire des tweets
for filename in os.listdir(tweets_directory):
    if filename.endswith(".txt"):
        file_path = os.path.join(tweets_directory, filename)
        output_path = os.path.join(output_directory, f"{os.path.splitext(filename)[0]}.json")
        convert_tweet_file_to_json(file_path, output_path)
        print(f"Fichier converti: {output_path}")

print("Conversion terminée.")