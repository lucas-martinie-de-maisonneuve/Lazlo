<?php
$config = yaml_parse_file(__DIR__ . '/../config/config.yaml');
$githubUser = $config['github']['user'];
$githubRepo = $config['github']['repo'];
$githubBranch = $config['github']['branch'];

$apiUrl = "https://api.github.com/repos/$githubUser/$githubRepo/commits?sha=$githubBranch";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0');

$response = curl_exec($ch);
curl_close($ch);

$commits = json_decode($response, true);

if (!empty($commits)) {
    $latestCommits = array_slice($commits, 0, 3);
    echo json_encode($latestCommits);
} else {
    echo json_encode(["error" => "Impossible de récupérer les commits"]);
}
?>
