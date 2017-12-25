# Guide

Pour travailler en groupe sur le projet veuillez créer un compte GitHub et installer Git sur votre PC.
Ensuite, installez Wamp/Mamp Server en fonction de votre système d'exploitation.
Pour finir, installez Composer.

## Liens:
| Outils | Liens |
| ------ | ------ |
| Git | [https://git-scm.com/] [PlGh] |
| Github | [plugins/github/README.md] [PlGh] |
| Wamp Server (Pour Windows) | [http://www.wampserver.com/] [PlGd] |
| Mamp Server (Pour MAC) | [https://www.mamp.info/en/downloads/] [PlGd] |
| Composer (Gestionnaire de dépendance PHP) | [https://getcomposer.org/download/] [PlOd] |

# Récupération du projet existant
- Déplacez vous à l'aide du terminal dans le répertoire suivant :
-- (Pour Windows) : "C:\wamp64\www" 
-- (Pour MAC) : "/Applications/MAMP/htdocs/" 
- Exécutez la commande suivante  : 
```sh
$ git clone https://github.com/AssiyaHsaini/nursinghome.git 
```
# Lancement du serveur
- Ouvrez Wamp ou Mamp selon votre OS et lancez le serveur
- Ouvrez votre navigateur (Chrome de préférence) et allez à l'adresse suivante :
 --  (Sur Windows) : "localhost/nursinghome"
 -- (Sur Mac) : "localhost:8888/nursinghome"
- Et voilà...

# Durant le développement
Pour faciliter le travail de groupe, créez vous une branche Git et travaillez dessus
```sh
# Créer et basculer sur la nouvelle branch
$ git branch nom_de_ma_branch
$ git checkout nom_de_ma_branch
```

Aussi à chaque création de Class/Controller/Service (etc), dans le code PHP. Vous devez mettre à jour l'autoloader de Composer. Pour ce faire, dans le terminal tapez :

```sh
composer dump-autoload -o
```

# Mémo des commandes Git
https://www.lije-creative.com/memo-git-en-ligne-commande/
