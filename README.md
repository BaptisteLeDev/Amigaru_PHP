# Projet_AmigaruWeb

### 18/01/25 
> 11h20 - Création des fichiers README.md et .gitignore.
> 11h30 - Initialisation de projet, création de l'espace VSCode & connexion à Github
> 12h00 - Clonâge, **Push** & Synchronisation réussi
> 12h20 - Mise en place de la structure du projet : /public, /src, /docs, /config & fichier .env & **Push**

> 12h25 - Début du Modèle Conceptuel de Données (MCD).
> 12h40 - MCD simplifier par GPT :
[Users]                  [Pages]               [Sections]
+------------+           +------------+        +------------------+
| id (PK)    |---+    +--| id (PK)    |---+    | id (PK)          |
| email      |   |    |  | user_id (FK)|  |    | page_id (FK)     |
| password   |   +----+  | title      |   +----| section_number   |
| role       |           | created_at |        | content_type     |
| created_at |           | updated_at |        | content (text)   |
+------------+           +------------+        | image_url        |
                                               | image_size (px)  |
                                               +------------------+

![Image MCD - V2](https://myoctocat.com/assets/images/base-octocat.svg)