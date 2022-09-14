  $(document).ready(function(){
    $('.lookup, .num-players, .playtime').on('input', function(e) {
        let search = $(this).val().trim().toLowerCase();
        let numPlayers = parseInt($('.num-players').val());
        let availableTime = $('.playtime').val();
        $('.hide-game-name').removeClass('hide-game-name');
        $('.hide-available-time').removeClass('hide-available-time');
        $('.hide-num-players').removeClass('hide-num-players');
        $('tr.game').each(function(i) {
          let name = $(this).find('.name').text().toLowerCase();
          let badgeHash = '';

          let upc = $(this).find('.name').data('upc').toString().toLowerCase();
          let minPlayers = parseInt($(this).find('.min-players').text());
          let maxPlayers = parseInt($(this).find('.max-players').text());
          let minPlaytime = parseInt($(this).find('.min-playtime').text());
          let maxPlaytime = parseInt($(this).find('.max-playtime').text());
          if($(this).find('.badge-hash').length > 0) {
            badgeHash = $(this).find('.badge-hash').data('badge').toString().toLowerCase();
            console.log(search != '', !name.includes(search), !upc.includes(search), !badgeHash.includes(search) );
          }

          if(search != '' && !name.includes(search) && !upc.includes(search) && !badgeHash.includes(search) ) {
            $(this).addClass('hide-game-name');
          }

          if(numPlayers != '' && (numPlayers < minPlayers || numPlayers > maxPlayers)) {
            $(this).addClass('hide-num-players');
          }

          if(availableTime != '' && (availableTime < maxPlaytime)) {
            $(this).addClass('hide-available-time');
          }
        });
    });
  });