<html>
<head>
	<title>dashboard</title>
	<style>
		.quote{
			border: 1px solid black;
			border-radius: 25px;
			margin-bottom: 20px;
		}
		#big_boy{
			width: 300px;
			height: 400px;
			display: inline-block;
			border: 2px solid black;
			padding: 10px;
			overflow: scroll;
		}
		#also_big_boy{
			width: 300px;
			height: 400px;
			display: inline-block;
			border: 2px solid black;
			padding: 10px;
			overflow: scroll;
		}
	</style>
</head>
<a href = "logout">Log Out</a>
<h1>Welcome, <?= $user["name"] ?></h1>
<form action = 'add_quote' method = "post">
	Author: <input type = "text" name = 'author'><br>
	Quote: <input type = "text" name = "quote"><br>
	<input type = 'submit' value = 'add quote'>
</form>

<div id = 'big_boy'>
<h2>Quotable Quotes</h2>
<?php foreach($results as $res) { ?>
	<div class = "quote">
		<h3><?= $res["author"] ?>: <?= $res["quote"] ?></h3>
		<form action = "add_fave" method = "post">
			<input type = "hidden" name = 'user_id' value = "<?= $user['idusers']?>">
			<input type = "hidden" name = 'quote_id' value = "<?= $res['idquotes']?>">
			<input type = 'submit' value = "add to faves">
		</form>
	</div>
<?php
}
?>
</div>
<div id = "also_big_boy">
<h2>Quotable Quotes</h2>

<?php foreach($favorites as $faves) { ?>
	<div class = "quote">
		<h3><?= $faves["author"] ?>: <?= $faves["quote"] ?></h3>
		<form action = "delete_fave" method = 'post'>
			<input type = "hidden" name = "fave_id" value = "<?= $faves['idfavorites']?>">
			<input type = "submit" value = "remove from faves">
		</form>
	</div>
<?php
}
?>
</div>
