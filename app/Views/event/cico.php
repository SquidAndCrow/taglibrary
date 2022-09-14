
<div class="row">
  <div class="col-md-12">
    <h2 style="margin-top: 1em;"><?php echo $events['name'];?> Checkin/Checkout</h2>

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
      <th class="sticky-top"></th>
      <th class="sticky-top"></th>
    </tr>
  </thead>
    <?php foreach ($games as $g): ?>

      <tr class="game">
        <td class="thumb"><img src="<?= esc($g['thumb_url']) ?>" class="game-thumb"></td>
        <td data-upc="<?= esc($g['upc']) ?>" class="name"><?= esc($g['name']) ?></td>
        <td class="min-players"><?= esc($g['min_players']) ?></td>
        <td class="max-players"><?= esc($g['max_players']) ?></td>
        <td class="min-playtime"><?= esc($g['min_playtime']) ?></td>
        <td class="max-playtime"><?= esc($g['max_playtime']) ?></td>
        <?php if (is_null($g['checkout']) || (!is_null($g['checkout']) && !is_null($g['checkin']))) : ?>
          <td><input type="text" value="" placeholder="Badge ID" class="form-control badge-id"></td>
          <td><a href="" class="btn btn-primary checkout"  data-id="<?=esc($g['library_id']);?>">Check Out</a></td>
        <?php else: ?>
          <td class="badge-hash" data-badge="<?=esc($g['badge_hash']);?>"></td>
          <td><a href="" class="btn btn-success checkin" data-id="<?=esc($g['cico_id']);?>">Check In</a></td>
        <?php endif; ?>
      </tr>
    <?php endforeach; ?>
  </table>
    <?php else : ?>
    NO GAMES
    <?php endif ?>
  </div>
</div>
<script src='/js/filter.js'></script>
<script>
  $(document).ready(function(){
    $('.checkin').on('click', function(e){
      e.preventDefault();
      let id = $(this).data('id');
      let t = {};
      t.id = id;
      $.ajax({
        url : '/events/gameCheckIn',
        data : t,
        method : 'POST',
        success : function(res) {
          location.reload();
        }
      });
    });

    $('.checkout').on('click', function(e){
      e.preventDefault();
      let id = $(this).data('id');
      let t = {};
      t.id = id;
      t.badge_hash = $(this).parent().parent().find('.badge-id').val();
      console.log(t);
      $.ajax({
        url : '/events/gameCheckOut',
        data : t,
        method : 'POST',
        success : function(res) {
          console.log(res);
          location.reload();
        }
      });
    });
  });
</script>