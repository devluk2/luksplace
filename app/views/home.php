<?php
// $conn = get_sqlite_connection();
// if ($conn) {
//   $stmt = $conn->prepare("SELECT title, unixepoch(created_at) as created_at, text FROM blog ORDER BY created_at DESC");
//   $stmt->execute();
//   $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
// } else {
//   echo "Failed to establish a connection to the local SQLite database." . PHP_EOL;
// }
?>
<!-- <h2>Disclaimer</h2>
<p>Please note that this is my personal page. If you feel offended in any way - this is not my problem - stop reading and go somewhere else where you would feel more comfortable.</p> -->

<?php /* foreach ($result as $row): ?>
  <section>
    <h3><?= $row['title'] ?></h3>
    <mark><?= date('d/m/Y', $row['created_at']) ?></mark>
    <div><?= $row['text'] ?></div>
  </section>
<?php endforeach; */ ?>

<h2>Welcome to my place!</h2>

<p>This is my personal website where I will put whatever I find interesting.</p> 
<p>Please feel free to reach out in case you need anything!</p>