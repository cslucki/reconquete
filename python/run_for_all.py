import subprocess
import yaml

# Charger les données YAML
with open(r'D:\reconquete\data.yaml', 'r', encoding='utf-8') as file:
    candidates = yaml.safe_load(file)

# Demander à l'utilisateur l'enregistrement de départ et de fin
start_index = int(input("Entrez l'enregistrement de départ (index, commence à 1) : ")) - 1
end_index = int(input("Entrez l'enregistrement de fin (index, inclusif) : ")) - 1

# Vérifier que les indices sont valides
if start_index < 0 or end_index >= len(candidates) or start_index > end_index:
    print("Indices invalides. Veuillez vérifier les valeurs et réessayer.")
    exit(1)

# Parcourir chaque candidat dans la plage spécifiée et exécuter le script get_x_byID.py
for candidate in candidates[start_index:end_index + 1]:
    twitter_url = candidate.get('twitter')
    if twitter_url:
        twitter_handle = twitter_url.split('/')[-1]
        print(f"Fetching tweets for {twitter_handle} (ID: {candidate['id']})")
        subprocess.run(['python', r'D:\reconquete\python\get_x_byID.py', twitter_handle, str(candidate['id'])])
    else:
        print(f"Le candidat avec l'ID {candidate['id']} n'a pas de compte Twitter.")