<?php
$api_url = "https://api.api-ninjas.com/v1/quotes";
$api_key = "AA4eTPNfVJOz6j9nBC6BXg==CU069T64hsc95zhK";

$options = [
  "http" => [
    "header" => "X-Api-Key: " . $api_key
  ]
];

$context = stream_context_create($options);
$response = file_get_contents($api_url, false, $context);

if ($response === FALSE) {
  echo "Error fetching data";
} else {
  $data = json_decode($response, true);
  $quote = htmlspecialchars($data[0]['quote']);
  $author = htmlspecialchars($data[0]['author']);
}
?>

<blockquote>
  <p><?= $quote ?></p>
  <p><cite>– <?= $author ?></cite></p>
</blockquote>