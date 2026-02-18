<div class="row">
    <div class="col-sm-12">
<p>
<h1> Winner! </h1>
<p>
The winner was Player <?php echo $winner; ?> - congratulations, <?php echo $winnerName; ?>
</div>
</div>

<div class="row">
    <div class="col-sm-6">
<table border="1" class="tictactoe">
<?php 
$row = 0;
?>
<?php foreach ($grid as $array): ?>
	<tr>
	<?php 
	$col = 0;
	?>
	<?php foreach ($array as $entry): ?>
		<td class="tictactoe"><?php if($entry == "") { echo "&nbsp;<a href='#'>-</a>&nbsp;"; } else { echo $entry; } ?></td>
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
    <h4> Game Options </h4>
<p>
You can always <a href="/tictactoe/index.php/create/">Start Over</a>
</p>
</div>
</div>