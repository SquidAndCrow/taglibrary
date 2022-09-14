
<div class="row">
  <div class="col-md-12">
    <h2 style="margin-top: 1em;"><?php echo $events['name'];?> Game Library</h2>

  </div>
</div>
<?= $this->include('templates/game_filter'); ?>
<div class="row">
  <div class="col-md-12">
    <?php if (! empty($games) && is_array($games)) : ?>
<table class="table striped" style="margin-top: 1em;">
  <thead class="thead-dark">
    <tr>
      <th class="sticky-top"></th>
      <th class="sticky-top">Name</th>
      <th class="sticky-top">Min Players</th>
      <th class="sticky-top">Max Players</th>
      <th class="sticky-top">Min Playtime</th>
      <th class="sticky-top">Max Playtime</th>
    </tr>
  </thead>
    <?php foreach ($games as $g): ?>

      <tr class="game">
        <td class="thumb"><img src="<?= esc($g['thumb_url']) ?>" class="game-thumb"></td>
        <td data-upc="<?= esc($g['upc']) ?>" class="name"><a href="/game/profile/<?= esc($g['upc']) ?>"><?= esc($g['name']) ?></a></td>
        <td class="min-players"><?= esc($g['min_players']) ?></td>
        <td class="max-players"><?= esc($g['max_players']) ?></td>
        <td class="min-playtime"><?= esc($g['min_playtime']) ?></td>
        <td class="max-playtime"><?= esc($g['max_playtime']) ?></td>
      </tr>
    <?php endforeach; ?>
  </table>
    <?php else : ?>
    NO GAMES
    <?php endif ?>
  </div>
</div>
<script src='/js/filter.js'></script>