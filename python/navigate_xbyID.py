import time
import yaml
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import argparse
from dateutil import parser as date_parser
from babel.dates import format_datetime
import locale
import os

# Configurer le locale pour le français
locale.setlocale(locale.LC_TIME, 'fr_FR')

# Configuration de l'analyse des arguments
parser = argparse.ArgumentParser(description='Fetch tweets for a given candidate ID.')
parser.add_argument('candidate_id', type=int, help='Candidate ID')
args = parser.parse_args()

# Lire le fichier data.yaml pour obtenir le nom d'utilisateur Twitter correspondant à l'ID
with open(r'D:\reconquete\data.yaml', 'r', encoding='utf-8') as file:
    data = yaml.safe_load(file)

candidate = next((item for item in data if item['id'] == args.candidate_id), None)
if not candidate:
    raise ValueError(f"Candidate with ID {args.candidate_id} not found.")

username = candidate['twitter'].split('/')[-1]

# Configuration de Selenium et ChromeDriver
options = Options()
options.add_argument("--disable-notifications")
options.add_argument("--headless")  # Exécuter en mode headless si vous ne voulez pas voir le navigateur
service = Service(r'D:\python\chromedriver-win64\chromedriver.exe')  # Assurez-vous que le chemin est correct

driver = webdriver.Chrome(service=service, options=options)

# Aller sur la page de connexion de Twitter
driver.get("https://x.com/i/flow/login")
time.sleep(2)

# Remplir le formulaire de connexion
username_input = driver.find_element(By.NAME, "text")
username_input.send_keys("CVStreetorg")
username_input.send_keys(Keys.RETURN)
time.sleep(2)  # Attendre le chargement de l'étape suivante

password_input = driver.find_element(By.NAME, "password")
password_input.send_keys("metroboulot2012")
password_input.send_keys(Keys.RETURN)
time.sleep(5)  # Attendre le chargement de la page après connexion

# Naviguer vers la page de l'utilisateur
user_url = f"https://twitter.com/{username}"
driver.get(user_url)
time.sleep(5)

# Scroller la page pour charger plus de tweets
scroll_pause_time = 2
max_tweets = 30
collected_tweets = []

while len(collected_tweets) < max_tweets:
    tweets = driver.find_elements(By.CSS_SELECTOR, 'article')
    for tweet in tweets:
        if len(collected_tweets) >= max_tweets:
            break
        try:
            tweet_text = tweet.find_element(By.CSS_SELECTOR, 'div[lang]').text
            tweet_date = tweet.find_element(By.CSS_SELECTOR, 'time').get_attribute('datetime')
            tweet_date = date_parser.parse(tweet_date)
            formatted_date = format_datetime(tweet_date, locale='fr_FR')
            collected_tweets.append((formatted_date, tweet_text))
        except Exception as e:
            print(f"Erreur lors de la récupération d'un tweet : {e}")
    driver.execute_script("window.scrollTo(0, document.body.scrollHeight);")
    time.sleep(scroll_pause_time)

driver.quit()

# Définir le répertoire de sortie
output_dir = r'D:\reconquete\tweets'
os.makedirs(output_dir, exist_ok=True)

# Générer le nom de fichier avec le chemin complet en utilisant l'ID du candidat
output_filename = os.path.join(output_dir, f"{args.candidate_id}.txt")

# Écrire les tweets dans le fichier
with open(output_filename, 'w', encoding='utf-8') as file:
    for tweet in collected_tweets:
        file.write(f"Date: {tweet[0]}\n")
        file.write(f"Tweet: {tweet[1]}\n\n")

print(f"Les tweets ont été sauvegardés dans le fichier: {output_filename}")