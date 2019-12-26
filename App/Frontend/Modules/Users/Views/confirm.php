<?php
    /**
     * -------------------------------------------------------------------------------
     * =========    ALGORITHME GESTION DE CONFIRMATION D'INSCRIPTION =================
     * -------------------------------------------------------------------------------
     * si le nom d'utilisateur et le token sont vide => on affiche un message d'erreur
     * recuperation des informations de l'utilisateur en cours dans la BDD
     * si le nom d'utilisateur et le token sont different de ceux recuperer dans la base de 
     * donnees => on affiche un message d'erreur et on redirige vers la page d'accueil
     * si aucune erreur n'est detectée => on affiche un message de succes et on redirige 
     * vers la page de connexion
     */ 