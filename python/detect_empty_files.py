import os

# Définir le chemin du répertoire contenant les fichiers texte
tweets_dir = r'D:\reconquete\tweets'

# Parcourir tous les fichiers dans le répertoire
for filename in os.listdir(tweets_dir):
    # Vérifier si le fichier a une extension .txt
    if filename.endswith('.txt'):
        file_path = os.path.join(tweets_dir, filename)
        # Vérifier si le fichier est vide
        if os.path.getsize(file_path) == 0:
            print(f"Fichier {filename} ne contient aucune donnée.")