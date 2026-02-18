<div class="row">
    <div class="col-sm-6">
<h2><?php echo $title; ?></h2>

<?php echo validation_errors(); ?>

<?php echo form_open('game/create'); ?>

    <label for="player1">Player 1 Name</label>
    <input type="input" name="player1" /><br />

    <label for="text">Player 2 Name</label>
    <input type="input" name="player2" /><br />

    <input type="submit" name="submit" value="Play The Game" />

</form>
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
