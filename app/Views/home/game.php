<div class="row">
  <div class="col-md-12">
    <?php if (! empty($games) && is_array($games)) : ?>
        <h3><?= esc($games['name']) ?></h3>
        <p>Name: <input type="text" class="name form-control" value="<?=esc($games['name']);?>"> <a href="" class="api-pull search btn btn-xs btn-primary">Pull info from Board Game Atlas</a></p>
        <div class="game-results alert alert-success" style="display: none;">

        </div>
        <p>UPC/Bar Code: <input type="text" class="upc form-control" value="<?=esc($games['upc']);?>"><input type="hidden" class="bga-id form-control" value="<?=esc($games['bga-id']);?>"></p>
        <p>Minumum Players: <input type="number" class="min-players form-control" value="<?=esc($games['min_players']);?>"></p>
        <p>Maximum Players: <input type="number" class="max-players form-control" value="<?=esc($games['max_players']);?>"></p>
        <p>Minumum Playtime (minutes): <input type="number" class="min-playtime form-control" value="<?=esc($games['min_playtime']);?>"></p>
        <p>Maximum Playtime (minutes): <input type="number" class="max-playtime form-control" value="<?=esc($games['max_playtime']);?>"></p>
        <p>Thumbnail URL: <input type="text" class="thumb-url form-control" value="<?=esc($games['thumb_url']);?>"></p>
        <p>Full Image URL: <input type="text" class="image-url form-control" value="<?=esc($games['image_url']);?>"></p>
        <p>Rules URL: <input type="text" class="rules-url form-control" value="<?=esc($games['rules_url']);?>"></p>
        <p>Description:<br><textarea class="form-control description" style="height: 10em;"><?=esc($games['description']);?></textarea></p>
        <a href="" class="btn btn-primary btn-submit">Submit</a>
    <?php else : ?>
      none;
    <?php endif ?>
  </div>
</div>
<script>
$(document).ready(function(){

  let gameResults = {};

  let showAPIresults = function() {
    $('.game-results').hide();
    let msg = "";
    if (gameResults.games.length == 0) {
      msg = "No game data returned";
    } else {
      msg += "<h4>Which game below matches the game you're entering:</h4>"
      gameResults.games.forEach(function(i, index) {
        msg += `<li>
                  <a href="" class="game-info" data-index="${index}">${i.name}</a>
                </li>`;
      });
      msg += `<li>If none of these match the game you're looking for, please enter the game information below</li>`;
    }
    $('.game-results').html(msg).show();
  }

  $('.game-results').on('click', '.game-info', function(e){
    e.preventDefault();
    let index = $(this).data('index');
    let game = gameResults.games[index];
    $('.game-results').hide();
    $('.min-players').val(game.min_players);
    $('.max-players').val(game.max_players);
    $('.min-playtime').val(game.min_playtime);
    $('.max-playtime').val(game.max_playtime);
    $('.thumb-url').val(game.thumb_url);
    $('.image-url').val(game.image_url);
    $('.rules-url').val(game.rules_url);
    $('.description').val(game.description);
    $('.bga-id').val(game.id);
  });

  $('.search').on('click', function(e) {
    e.preventDefault();
    console.log('clicked');
    let search = $('.name').val().trim();
    $.ajax({
      url: 'https://api.boardgameatlas.com/api/search?exact_match=true&limit=15&name='+search+'&client_id=l4VJwkffMK',
      success : function(res) {
        gameResults = res;
        console.log(res);
        showAPIresults();
      },
      error : function(err) {
        console.log(err);
      }
    });
  });

  $('.btn-submit').on('click', function(e) {
    e.preventDefault();
    let t = {};
    t.id = <?= esc($games['id']) ?>;
    t.min_players = $('.min-players').val();
    t.bga_id = $('.bga-id').val();
    t.max_players = $('.max-players').val();
    t.min_playtime = $('.min-playtime').val();
    t.max_playtime = $('.max-playtime').val();
    t.description = $('.description').val();
    t.thumb_url = $('.thumb-url').val();
    t.image_url = $('.image-url').val();
    t.rules_url = $('.rules-url').val();
    t.upc = $('.upc').val();
    t.name = $('.name').val();
    t.bga_id = $('.bga-id').val();
    console.log(t);
    $.ajax({
      url : '/game/edit/<?= esc($games['id']) ?>',
      method : 'POST',
      data : t,
      success : function(res) {
        console.log(res);
        location.href="/";
      }
    })
  });

});
</script>