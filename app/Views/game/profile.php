<div class="row">
  <div class="col-md-4 game-image" style="margin-top: 1em;">
    <img src="<?=esc($games['image_url']);?>">
  </div>
  <div class="col-md-8">
    <?php if (! empty($games) && is_array($games)) : ?>
        <h3><?= esc($games['name']) ?></h3>
        <p><span style="font-weight: bold">UPC/Bar Code:</span> <?=esc($games['upc']);?></p>
        <p><span style="font-weight: bold">Player Count:</span> <?=esc($games['min_players']);?> - <?=esc($games['max_players']);?></p>
        <p><span style="font-weight: bold">Playtime (minutes):</span> <?=esc($games['min_playtime']);?> - <?=esc($games['max_playtime']);?></p>
        <p><span style="font-weight: bold">Rules URL:</span> <a href="<?=esc($games['rules_url']);?>" target="_blank"><?=esc($games['rules_url']);?></a></p>
        <p><span style="font-weight: bold">Description:</span></p>
        <?=$games['description'];?>
    <?php else : ?>
      none;
    <?php endif ?>
  </div>
</div>