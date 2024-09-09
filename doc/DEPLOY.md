# Déploiement

## Réservation du nom de domaine

### Questions

1) Expliquer la procédure pour réserver un nom de domaine chez OVH avec des captures d'écran (arrêtez-vous au paiement) :

Pour reserver un nom de domaine OVH nous devons nous rendre sur leur site.
![alt text](ovh_accueil.png)

Ensuite nous recherchons un nom de domaine a acheter.
![alt text](ovh_domaine.png)

On l'ajoute dans le panier:
![alt text](ovh_acheter.png)

Il propose divers options que nous ne prenons pas. Nous devrons donc nous connecter puis acheter a l'aide de coordonée bancaire le nom de domaine

2. Comment faire pour qu'un nom de domaine pointe vers une adresse IP spécifique ?

La manière de lier un nom de domaine a une adresse IP spécifique est toujours la même car il s'agit de parametrer les DNS 
(Domain Name Service)

Concernant les interfaces des hébergeurs, elles ont toujours plus ou moins la même ergonomie avec un onglet "redirection" puis une option "ajouter une redirection". A partir de la il suffit de saisir le sous domaine concerné et sélectionner une redirection vers une url/ domaine ou adresse IP.


## Préparation du VPS

Pour préparer le VPS a servir l'application il y a quelque étape.
Tout d'abord il faut installer aapanel qui est un panneau de controle voici la commande pour installer aapanel sur notre serveur debian 11
```bash URL=https://www.aapanel.com/script/install_7.0_en.sh && if [ -f /usr/bin/curl ];then curl -ksSO "$URL" ;else wget --no-check-certificate -O install_7.0_en.sh "$URL";fi;bash install_7.0_en.sh aapanel ```

Une fois l'installation faite voici les identifiants et l'adresse pour accèder a l'interface de aapanel 
Adresse : https://172.16.1.236:23951
Identifiant : kqsxhbsy
Mot de passe : passpass

Une fois connecté a l'interface nous pouvons installer nginx et mysql.
Après cela on se dirige vers l'onglet website et nous créeons une application a l'adresse 172.16.1.236
Ce qui aura pour conséquence de créer un fichier a l'arborescence www/wwwroot/172.16.1.236 dans notre machine linux hébergeant aapanel

Après cela nous allons connecter notre répertoire git a le push a notre service aapanel.
Il faut donc aller dans la machine linux créer un fichier dans le dossier var qui accueillera votre application 
```bash mkdir -p nom_du_projet_git```

Dossier dans lequel nous allons initialiser une repository git avec la commande suivante :
```bash git --bare init ```

Après cela nous allons dans notre windows serveur dans lequel nous allons venir servir le projet dans le linux a l'aide de la commande : 
```bash git remote add vps ssh://root@172.16.1.236/var/app ```

Il ne reste plus que a envoyer les fichiers : 
```bash git push -v vps master```
Après cela les fichiers seront disponible dans aapanel dans l'arborescence www/wwwroot/172.16.1.236 
