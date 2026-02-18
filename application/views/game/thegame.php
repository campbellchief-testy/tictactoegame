<h1> Tic Tac Toe </h1>
<div class="row">
    <div class="col-sm-6">
     <p>
<strong>Player 1:</strong> <?php echo $player1; ?>
</p>
<p>
<strong>Player 2:</strong> <?php echo $player2; ?>
</p>
    </div>
    <div class="col-sm-6">
      <p>
<strong>Current Turn:</strong>
<?php 
if($turn == 1) {
	echo "It's $player1 to play.";
}
else {
	echo "It's $player2 to play.";
}
?>
</p>
    </div>
</div>

<?php
if($errorStatus > 0) {
	?>
	<div class="row">
    <div class="col-sm-12">
	<div class='error'>Error: <?php echo $error; ?></div>
	</div>
	</div>
	<?php
}
?>


<div class="row">
    <div class="col-sm-6">
<div class="info">
<strong>Information - Turns left:</strong> <?php echo $turnsLeft; ?>
</div>
<table class="tictactoe">
<?php 
$row = 0;
?>
<?php foreach ($grid as $array): ?>
	<tr>
	<?php 
	$col = 0;
	?>
	<?php foreach ($array as $entry): ?>
		<td class="tictactoe"><?php if($entry == "") { echo "&nbsp;<a href='/tictactoe/index.php/add?row=$row&col=$col'>-</a>&nbsp;"; } else { echo $entry; } ?></td>
		<?php $col++; ?>
	<?php endforeach; ?>
	</tr>
	<?php $row++; ?>
<?php endforeach; ?>
</table>
</div>
    <div class="col-sm-6">
    <h3> Latest Game Results </h3>
<?php foreach ($summary as $summary_item): ?>

        <h4><?php echo $summary_item['p1_name']; ?> vs <?php echo $summary_item['p2_name']; ?></h4>
        <div class="main">
                <strong>Won by:</strong> <?php echo $summary_item['winner_name']; ?>
        </div>
		<p> <strong>Played:</strong> <?php echo date('l jS \of F Y h:i:s A', $summary_item['date_game']);?>
<?php endforeach; ?>
    
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
    <h4> Game Options </h4>
<p>
You can always <a href="/tictactoe/index.php/create/">Start Over</a>
</p>
</div>
</div>