<?php


// films_recents.php
require_once "autoload.php";
include_once("session.php");


// On peut commencer par vérifier si l'utilisateur est connecté, sinon rediriger vers la page de login
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Films Récents - Cinema Paradiso</title>
    <link rel="stylesheet" href="style.css">
    <script src="index.js" defer></script>
</head>
<body>
<header>
    <h1>Films Récents</h1>
    <a href="logout.php" class="logout">Se déconnecter</a>
</header>
<div class="filters">
    <button id="popular">Films Populaires</button>
    <button id="upcoming">Films à venir</button>
    <input type="text" id="search" placeholder="Rechercher un film">
    <button id="btn"><i class="bx bx-search"></i></button>
</div>

<main id="main">
    <!-- Les films seront injectés ici -->
</main>

<script>
    // Déclarations des variables globales
    const btn = document.getElementById("btn");
    const search = document.getElementById("search");
    const main = document.getElementById("main");
    const popularbtn = document.getElementById("popular");
    const upcomingMovies = document.getElementById("upcoming");

    const imgUrl = "https://image.tmdb.org/t/p/w500";
    const apiKey = "82852eff9923affa42136eb1e81e3ffd"; // À ne pas exposer en production
    const baseUrl = "https://api.themoviedb.org/3";
    const options = {
        method: "GET",
        headers: {
            accept: "application/json",
            Authorization: "Bearer YOUR_ACCESS_TOKEN" // Remplace par un token valide
        },
    };

    // Fonction pour récupérer les films populaires
    function getPopularMovies() {
        main.innerHTML = "";
        const url = `${baseUrl}/discover/movie?sort_by=popularity.desc&api_key=${apiKey}&language=fr-FR`;
        
        fetch(url, options)
            .then((res) => res.json())
            .then((data) => {
                data.results.forEach((movie) => {
                    const movieDiv = document.createElement("div");
                    movieDiv.classList.add("movie");
                    movieDiv.innerHTML = `
                        <img src="${imgUrl + movie.poster_path}" alt="${movie.title}">
                        <h3>${movie.title}</h3>
                    `;
                    main.appendChild(movieDiv);
                });
            })
            .catch((error) => {
                console.error('Erreur lors de la récupération des films populaires:', error);
                main.innerHTML = "<p>Une erreur est survenue, veuillez réessayer plus tard.</p>";
            });
    }

    // Fonction pour récupérer les films à venir
    function getUpcomingMovies() {
        main.innerHTML = "";
        const url = `${baseUrl}/movie/upcoming?api_key=${apiKey}&language=fr-FR`;

        fetch(url, options)
            .then((res) => res.json())
            .then((data) => {
                data.results.forEach((movie) => {
                    const movieDiv = document.createElement("div");
                    movieDiv.classList.add("movie");
                    movieDiv.innerHTML = `
                        <img src="${imgUrl + movie.poster_path}" alt="${movie.title}">
                        <h3>${movie.title}</h3>
                    `;
                    main.appendChild(movieDiv);
                });
            })
            .catch((error) => {
                console.error('Erreur lors de la récupération des films à venir:', error);
                main.innerHTML = "<p>Une erreur est survenue, veuillez réessayer plus tard.</p>";
            });
    }

    // Rechercher un film par le terme de recherche
    btn.addEventListener("click", () => {
        const query = search.value;
        if (query === "") {
            getPopularMovies(); // Si la recherche est vide, afficher les films populaires
        } else {
            searchMovies(query); // Effectuer la recherche
        }
    });

    // Fonction pour effectuer la recherche
    function searchMovies(query) {
        main.innerHTML = "";
        const url = `${baseUrl}/search/movie?query=${query}&api_key=${apiKey}&language=fr-FR`;

        fetch(url, options)
            .then((res) => res.json())
            .then((data) => {
                data.results.forEach((movie) => {
                    const movieDiv = document.createElement("div");
                    movieDiv.classList.add("movie");
                    movieDiv.innerHTML = `
                        <img src="${imgUrl + movie.poster_path}" alt="${movie.title}">
                        <h3>${movie.title}</h3>
                    `;
                    main.appendChild(movieDiv);
                });
            })
            .catch((error) => {
                console.error('Erreur lors de la recherche:', error);
                main.innerHTML = "<p>Une erreur est survenue, veuillez réessayer plus tard.</p>";
            });
    }

    // Initialisation avec les films populaires par défaut
    window.onload = getPopularMovies;

    // Événements pour les boutons
    popularbtn.addEventListener("click", getPopularMovies);
    upcomingMovies.addEventListener("click", getUpcomingMovies);
</script>

</body>
</html>
