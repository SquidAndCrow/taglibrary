
<div class="row">
  <div class="col-md-12">
    <h2><?= esc($title) ?></h2>
    <div class="row d-print-none">
      <div class="col-md-3">
        <p><a href="/library/new" class="btn btn-primary">Add Game To Your Library</a>

        </p>
      </div>
      <div class="col-md-6">
        <select class="event form-control">
        <option value="">What event are you adding games to?</option>
        <?php foreach ($events as $event): ?>
          <option value="<?=$event['id'];?>"><?=$event['name'];?></option>
        <?php endforeach; ?>
      </select>
      </div>
      <div class="col-md-3">
        <label><input type="checkbox" class="pull-list"> Create Pull List?</label>
      </div>
    </div>
  </div>
</div>
<div class=" d-print-none">
<?= $this->include('templates/game_filter'); ?>
</div>
<div class="row">
  <div class="col-md-12">
    <?php if (! empty($games) && is_array($games)) : ?>
<table class="table striped" style="margin-top: 1em;">
  <thead class="thead-dark">
    <tr>
      <th class="sticky-top d-print-none"></th>
      <th class="sticky-top">Name</th>
      <th class="sticky-top">UPC</th>
      <th class="sticky-top">Min Players</th>
      <th class="sticky-top">Max Players</th>
      <th class="sticky-top">Min Playtime</th>
      <th class="sticky-top">Max Playtime</th>
      <th class="sticky-top d-print-none"></th>
      <th class="sticky-top d-print-none"></th>
    </tr>
  </thead>
    <?php foreach ($games as $g): ?>

      <tr class="game">
        <td class="thumb d-print-none"><img src="<?= esc($g['thumb_url']) ?>" class="game-thumb"></td>
        <td data-upc="<?= esc($g['upc']) ?>" class="name"><?= esc($g['name']) ?></td>
        <td class="upc"><?= esc($g['upc']) ?></td>
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
  </table>
    <?php else : ?>
    NO GAMES
    <?php endif ?>
  </div>
</div>
<script src='/js/filter.js'></script>
<script>
  $(document).ready(function(){
    $('table').on('click', '.add-to-event-library', function(e) {
      e.preventDefault();
      let event_id = $('.event').val();
      let games_libraries_id = $(this).data('id');
      let self = $(this);
      if(event_id != '') {
        $.ajax({
            url : '/events/library/add/' + event_id + '/' + games_libraries_id,
            success : function(res) {
              self.parent().parent().replaceWith(res);
            }
        })
      }
    });

    $('table').on('click', '.remove-from-event-library', function(e) {
      e.preventDefault();
      let game_id = $(this).data('id');
      let guid = $(this).data('guid');
      let self = $(this);
      $.ajax({
          url : '/events/library/remove/' + game_id + '/' + guid,
          success : function(res) {
            console.log(res);
            self.parent().parent().replaceWith(res);
          }
      })
    });

    $('.pull-list').on('change', function(e) {
      let eventName = $('.event option:selected').text().toLowerCase();

      if($(this).prop('checked')) {
        if($('.event')[0].selectedIndex != 0) {
          let eventName = $('.event option:selected').text().toLowerCase();
          $('tr.game').each(function(index){
            if(!$(this).find('.remove-from-event-library').text().toLowerCase().includes(eventName)) {
              $(this).hide();
            }
          });
          window.print();
        }
      } else {
        $('tr.game').show();
      }
    })
  });
</script>