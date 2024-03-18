[![ToDoList Vulnerable](https://i.postimg.cc/MGL0QQr1/logo.webp)](https://postimg.cc/SXWz0J4K)

# Projet : Gestionnaire de Tâches Personnelles - Sécurité Web

Ce projet concerne la conception, le développement et l'évaluation de deux versions d'une application de gestion des tâches personnelles : une version vulnérable présentant des failles de sécurité connues, et une version sécurisée intégrant des mesures de protection adéquates.

## Objectif du Projet

Le but est de créer deux variantes de l'application : une version exposée aux attaques pour mettre en lumière les vulnérabilités courantes dans le développement web, et une version renforcée pour démontrer les meilleures pratiques de sécurisation d'une application web.

## Description du Projet

- **Conception de l'Application Web** : 
  - **Fonctionnalités Communes** : Permettre la gestion de tâches personnelles telles que l'ajout, la modification et la suppression de tâches. Les tâches peuvent être marquées comme complétées. Un portail d'authentification est prévu pour accéder à la gestion avancée des tâches.
    - **Sans authentification** : Visualisation des tâches disponibles.
    - **Avec authentification** : Capacité à gérer les tâches de manière interactive.
  - **Technologies Utilisées** : HTML, CSS, JavaScript (frontend), PHP (backend), SQL (gestion des données).

- **Version Vulnérable** :
  - Intégration délibérée de vulnérabilités courantes telles que les injections SQL, XSS (Cross-Site Scripting), gestion incorrecte des sessions, problèmes de téléversement de fichiers, etc.
  - Documentation détaillée des vulnérabilités pour faciliter les tests et l'apprentissage.

- **Version Sécurisée** :
  - Mise en œuvre de pratiques de sécurité robustes telles que la validation et le nettoyage des entrées, l'escapade des sorties pour prévenir le XSS, et la gestion sécurisée des sessions.
  
- **Scénarios d'Attaque et Évaluation** :
  - Simulation d'attaques visant les vulnérabilités dans la version vulnérable et documentation des résultats.
  - Tentatives d'attaques contre la version sécurisée pour évaluer l'efficacité des mesures de sécurité.
  - Comparaison des résultats pour mettre en évidence les différences entre les deux versions.

- **Documentation Finale et Comparaison des Résultats** :
  - Rapport détaillant la conception, le développement, les vulnérabilités, les mesures de sécurité, et l'analyse des attaques simulées.
  - Évaluation de l'impact des différentes attaques et présentation des recommandations pour améliorer la sécurité des applications web.

## Livrables Attendus

- Code source des deux versions de l'application (disponible sur GitHub).
- Rapport détaillé comprenant la documentation de toutes les phases du projet.
- Présentation orale avec démonstration des deux versions de l'application, prévue pour le 20/03/2024.

## Critères d'Évaluation

- Intégration correcte et démontrable des vulnérabilités dans la version exposée.
- Implémentation effective et fonctionnelle des mesures de sécurité dans la version sécurisée.
- Qualité et précision des scénarios d'attaque, des résultats obtenus et de leur analyse.
- Clarté, exhaustivité et pertinence de la documentation et des recommandations fournies.
