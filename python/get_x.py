# utilisation: python get_x.py <username>
import requests
import json
import argparse
from dateutil import parser as date_parser
from babel.dates import format_datetime
import locale
import os

# Configurer le locale pour le français
locale.setlocale(locale.LC_TIME, 'fr_FR')

# Configuration de l'analyse des arguments
parser = argparse.ArgumentParser(description='Fetch tweets for a given username.')
parser.add_argument('username', type=str, help='Twitter username')
args = parser.parse_args()

username = args.username
url = f"https://syndication.twitter.com/srv/timeline-profile/screen-name/{username}"

r = requests.get(url)
html = r.text

start_str = '<script id="__NEXT_DATA__" type="application/json">'
end_str = '</script></body></html>'

start_index = html.index(start_str) + len(start_str)
end_index = html.index(end_str, start_index)

json_str = html[start_index: end_index]
data = json.loads(json_str)

# Limiter le nombre de tweets affichés à 100
max_tweets = 100

# Collecter les tweets avec leur date
tweets = []
for entry in data["props"]["pageProps"]["timeline"]["entries"]:
    tweet_content = entry["content"]["tweet"]
    # Vérifier si le tweet est un retweet ou un tweet original
    if "retweeted_status" in tweet_content:
        tweet = tweet_content["retweeted_status"]
    else:
        tweet = tweet_content

    tweet_text = tweet.get("full_text") or tweet.get("text")
    tweet_date = date_parser.parse(tweet['created_at'])
    formatted_date = format_datetime(tweet_date, locale='fr_FR')
    tweets.append((tweet_date, formatted_date, tweet_text))

# Trier les tweets par date décroissante
tweets.sort(reverse=True, key=lambda x: x[0])

# Définir le répertoire de sortie
output_dir = r'D:\reconquete\tweets'
os.makedirs(output_dir, exist_ok=True)

# Générer le nom de fichier avec le chemin complet
output_filename = os.path.join(output_dir, f"{username}_tweets.txt")

# Écrire les tweets dans le fichier
with open(output_filename, 'w', encoding='utf-8') as file:
    for tweet in tweets[:max_tweets]:
        file.write(f"Date: {tweet[1]}\n")
        file.write(f"Tweet: {tweet[2]}\n\n")

print(f"Les tweets ont été sauvegardés dans le fichier: {output_filename}")
