<div class="row">
  <div class="col-md-12">
        <h3>Add a Game to Your Library</h3>
        <p>Type the name of the game you want to add to your library in the name field below. If this tool knows about it, it will be displayed in the game listing. If it shows up, click the linked title, and click "Add to Library". If the game is unknown, try clicking the "Pull info from Board Game Atlas" to see if some of the necessary game information can be automatically pulled in. If all else fails, go ahead and type the game in manually.</p>
        <p>Name: <input type="text" class="name form-control" value=""></p>
        <div class="game-results alert alert-success" style="display: none;">

        </div>
        <p><a href="" class="api-pull search btn btn-xs btn-primary">Pull info from Board Game Atlas</a></p>
        <p>UPC/Bar Code: <input type="text" class="upc form-control" value=""><input type="hidden" class="bga-id form-control" value=""></p>
        <p>Add to Library?<br>
          <select class="curator form-control">
            <option></option>
            <?php foreach ($libraries as $l): ?>
              <option value="<?= $l['library_id'];?>"><?= $l['name'];?></option>
            <?php endforeach; ?>
          </select></p>
        <div class="game-data">
          <p>Minumum Players: <input type="number" class="min-players form-control" value=""></p>
          <p>Maximum Players: <input type="number" class="max-players form-control" value=""></p>
          <p>Minumum Playtime (minutes): <input type="number" class="min-playtime form-control" value=""></p>
          <p>Maximum Playtime (minutes): <input type="number" class="max-playtime form-control" value=""></p>
          <p>Thumbnail URL: <input type="text" class="thumb-url form-control" value=""></p>
          <p>Full Image URL: <input type="text" class="image-url form-control" value=""></p>
          <p>Rules URL: <input type="text" class="rules-url form-control" value=""></p>
          <p>Description:<br><textarea class="form-control description" style="height: 10em;"></textarea></p>
        </div>

        <a href="" class="btn btn-primary btn-submit">Submit</a>
        <a href="" class="btn btn-primary btn-library">Add to Library</a>
  </div>
</div>
<script>
$(document).ready(function(){

  let gameResults = {};

  let showAPIresults = function(library) {
    $('.game-results').hide();
    let msg = "";
    console.log(gameResults);
    if (gameResults.games.length == 0) {
      msg = "No game data returned - please try searching the Board Game Atlas database or enter the game information below";
    } else {
      msg += "<h4>Known Games:</h4>"
      gameResults.games.forEach(function(i, index) {
        msg += `<li>
                  <a href="" class="game-info" data-index="${index}" data-api="${library}">${i.name}</a>
                </li>`;
      });
      msg += `<li>If none of these match the game you're looking for, please try searching the Board Game Atlas database or enter the game information below</li>`;
    }
    $('.game-results').html(msg).show();
  }

  let showLibraryResults = function() {
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
    $('.game-results').hide();
    console.log($(this).data('api'));
    if($(this).data('api') == false) {
      let index = $(this).data('index');
      let game = gameResults.games[index];
      $('.name').val(game.name);
      $('.upc').val(game.upc);
      $('.min-players').val(game.min_players);
      $('.max-players').val(game.max_players);
      $('.min-playtime').val(game.min_playtime);
      $('.max-playtime').val(game.max_playtime);
      $('.thumb-url').val(game.thumb_url);
      $('.image-url').val(game.image_url);
      $('.rules-url').val(game.rules_url);
      $('.description').val(game.description);
      $('.bga-id').val(game.id);
      $('.btn-submit').show();
      $('.btn-library').hide();
    } else {
      let index = $(this).data('index');
      let game = gameResults.games[index];
      $('.upc').val(game.upc);
      $('.name').val(game.name);
      $('.game-data').hide();
      $('.btn-library').show();
      $('.btn-submit').hide();
    }
  });

  $('.name').on('input', function(e) {
    let search = $(this).val();
    if(search.length > 3) {
      $.ajax({
        url : '/games/getGamesByAll/' + search,
        success : function(res) {
          console.log(JSON.parse(res));
          gameResults.games = JSON.parse(res);
          showAPIresults(true);
        }
      })
    }
  });

  $('.search').on('click', function(e) {
    e.preventDefault();
    console.log('clicked');
    let search = $('.name').val().trim();
    $.ajax({
      url: 'https://api.boardgameatlas.com/api/search?fuzzy_match=true&limit=15&name='+search+'&client_id=l4VJwkffMK',
      success : function(res) {
        gameResults = res;
        console.log(res);
        showAPIresults(false);
      },
      error : function(err) {
        console.log(err);
      }
    });
  });

  $('.btn-submit').on('click', function(e) {
    e.preventDefault();
    let t = {};
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
    t.user_id = $('.curator').val();
    console.log(t);
    $.ajax({
      url : '/game/new',
      method : 'POST',
      data : t,
      success : function(res) {
        console.log(res);
        if($('.curator').val() != '') {
          t = {};
          t.game_id = $('.upc').val();
          t.library_id = $('.curator').val();
          console.log(t);
          $.ajax({
            url : '/library/addGameToLibrary',
            method : 'POST',
            data : t,
            success : function(res) {
              console.log(res);
              //location.href="/library/1";
            }
          })
        }
      }
    })
  });

  $('.btn-library').on('click', function(e) {
    e.preventDefault();
    let t = {};
    t.game_id = $('.upc').val();
    t.library_id = 1//$('.curator').val();
    console.log(t);
    $.ajax({
      url : '/library/addGameToLibrary',
      method : 'POST',
      data : t,
      success : function(res) {
        console.log(res);
        //location.href="/library/" + $('.curator').val();
      }
    })
  });

});
</script>