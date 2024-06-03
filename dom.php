<?php
require_once 'simple_html_dom.php';

// URL website Pragmatic Play
$url = "https://pragmaticplay.com/games/";

// Mengambil konten HTML dari website
$html = file_get_contents($url);

// Membuat objek Simple HTML DOM Parser
$dom = new simple_html_dom();
$dom->load($html);

// Mencari semua elemen game
$game_elements = $dom->find("div.game-item");

// Mengekstrak data game
$games = [];
foreach ($game_elements as $game_element) {
    $game = [
        "name" => trim($game_element->find("h3", 0)->plaintext),
        "description" => trim($game_element->find("p.game-item__description", 0)->plaintext),
        "image" => $game_element->find("img", 0)->src,
        "url" => $game_element->find("a", 0)->href
    ];
    $games[] = $game;
}

// Menampilkan data game
foreach ($games as $game) {
    echo "Name: " . $game["name"] . "\n";
    echo "Description: " . $game["description"] . "\n";
    echo "Image: " . $game["image"] . "\n";
    echo "URL: " . $game["url"] . "\n\n";
}
?>