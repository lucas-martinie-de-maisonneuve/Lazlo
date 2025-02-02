<?php
header('Content-Type: application/json');

// Charger la configuration en JSON
$configFile = __DIR__ . '/../config/config.json';
if (!file_exists($configFile)) {
    echo json_encode(["error" => "Le fichier de configuration JSON est manquant."]);
    exit;
}

$config = json_decode(file_get_contents($configFile), true);
if (!$config || !isset($config['github']['user'], $config['github']['repo'], $config['github']['branch'])) {
    echo json_encode(["error" => "Erreur dans la configuration JSON."]);
    exit;
}

$githubUser = $config['github']['user'];
$githubRepo = $config['github']['repo'];
$githubBranch = $config['github']['branch'];

$apiUrl = "https://api.github.com/repos/$githubUser/$githubRepo/commits?sha=$githubBranch";

// Initialisation de cURL avec timeout et SSL
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0");
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Désactive la vérification SSL si problème
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // Timeout après 10 sec

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

// Vérifier si la requête a échoué
if (!$response) {
    echo json_encode(["error" => "Erreur cURL : $error"]);
    exit;
}

if ($httpCode !== 200) {
    echo json_encode(["error" => "GitHub API erreur HTTP: $httpCode"]);
    exit;
}

// Décoder la réponse JSON
$commits = json_decode($response, true);

if (!empty($commits) && is_array($commits)) {
    echo json_encode(array_slice($commits, 0, 3));
} else {
    echo json_encode(["error" => "Aucun commit trouvé."]);
}
?>
