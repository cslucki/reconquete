import os
import subprocess
import yaml

# Définir le chemin du répertoire contenant les fichiers texte
tweets_dir = r'D:\reconquete\tweets'
data_file = r'D:\reconquete\data.yaml'
navigate_script = r'D:\reconquete\python\navigate_xbyID.py'

# Lire le fichier data.yaml pour obtenir les informations des candidats
with open(data_file, 'r', encoding='utf-8') as file:
    data = yaml.safe_load(file)

# Fonction pour obtenir l'ID du candidat à partir du nom de fichier
def get_candidate_id_from_filename(filename):
    return int(os.path.splitext(filename)[0])

# Parcourir tous les fichiers dans le répertoire
for filename in os.listdir(tweets_dir):
    # Vérifier si le fichier a une extension .txt
    if filename.endswith('.txt'):
        file_path = os.path.join(tweets_dir, filename)
        # Vérifier si le fichier est vide
        if os.path.getsize(file_path) == 0:
            candidate_id = get_candidate_id_from_filename(filename)
            candidate = next((item for item in data if item['id'] == candidate_id), None)
            if candidate:
                print(f"Le fichier {filename} est vide. Récupération des tweets pour le candidat ID {candidate_id}.")
                # Exécuter le script navigate_xbyID.py pour récupérer les tweets manquants
                subprocess.run(['python', navigate_script, str(candidate_id)])
            else:
                print(f"Le candidat avec l'ID {candidate_id} n'a pas été trouvé dans data.yaml.")