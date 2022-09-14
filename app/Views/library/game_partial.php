<?php foreach ($games as $g): ?>
  <tr class="game">
    <td class="thumb d-print-none"><img src="<?= esc($g['thumb_url']) ?>" class="game-thumb"></td>
    <td data-upc="<?= esc($g['upc']) ?>" class="name"><a href="/game/profile/<?= esc($g['upc']) ?>"><?= esc($g['name']) ?></a></td>
    <td><?= esc($g['upc']) ?></td>
    <td class="min-players"><?= esc($g['min_players']) ?></td>
    <td class="max-players"><?= esc($g['max_players']) ?></td>
    <td class="min-playtime"><?= esc($g['min_playtime']) ?></td>
    <td class="max-playtime"><?= esc($g['max_playtime']) ?></td>
    <td class="d-print-none"><a href="/game/<?=esc($g['upc']);?>" class="btn-sm btn btn-primary"><i class="fa fa-pencil" aria-hidden="true"></i></a></td>
    <td class="d-print-none"> <?php if (is_null($g['event_name'])) :?>
      <a href="" data-id="<?=esc($g['games_libraries_id']);?>" class="btn-sm btn btn-success add-to-event-library">Bring this Game to Selected Event <?= $g['event_name'];?></a>
    <?php else : ?>
      <a href="" data-id="<?=esc($g['library_id']);?>" data-guid="<?=esc($g['games_libraries_id']);?>" class="btn-sm btn btn-danger remove-from-event-library">Remove this Game from <?= $g['event_name'];?></a>
    <?php endif;?>
    </td>
  </tr>
<?php endforeach; ?>