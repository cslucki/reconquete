import time
from selenium import webdriver
from selenium.webdriver.common.keys import Keys
from selenium.webdriver.chrome.service import Service
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options
import argparse
from dateutil import parser as date_parser
from babel.dates import format_datetime
import locale

# Configurer le locale pour le français
locale.setlocale(locale.LC_TIME, 'fr_FR')

# Configuration de l'analyse des arguments
parser = argparse.ArgumentParser(description='Fetch tweets for a given username.')
parser.add_argument('username', type=str, help='Twitter username')
args = parser.parse_args()

# Configuration de Selenium et ChromeDriver
options = Options()
options.add_argument("--disable-notifications")
options.add_argument("--headless")  # Exécuter en mode headless si vous ne voulez pas voir le navigateur
service = Service('D:\\python\\chromedriver-win64\\chromedriver.exe')  # Assurez-vous que le chemin est correct

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
user_url = f"https://twitter.com/{args.username}"
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

# Afficher les tweets
for tweet in collected_tweets:
    print(f"Date: {tweet[0]}")
    print(f"Tweet: {tweet[1]}\n")
