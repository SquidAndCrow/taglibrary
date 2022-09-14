
<div class="row">
  <div class="col-md-12">
    <h2 style="margin-top: 1em;"><?php echo $event['name'];?><br><?php echo $room[0]['name'];?> Tables</h2>
    <div class="row">
      <div class="col-md-2">
        <label>Name<br>
        <input type="text" class="name form-control">
      </div>
      <div class="col-md-2">
        <label>Time Block<br>
        <input type="number" class="time-block form-control" min=1 step="0.5" value="1">
      </div>
      <div class="col-md-2">
        <label>Seats<br>
        <input type="number" class="seats form-control" min=1 step="1" value="1">
      </div>
    </div>
    <a href="" class="btn btn-primary add-table" data-eventid="<?php echo $event['id'];?>" data-roomid="<?php echo $room[0]['id'];?>">Add Table</a>
  </div>
</div>
<div class="row" style="margin-top: 1em;">
  <div class="col-md-12">
    <?php if (! empty($tables) && is_array($tables)) : ?>
      <table class="table striped">
        <tr>
          <th style="width: 20%">Name</th>
          <th style="width: 20%">Time Block</th>
          <th>Seats</th>
        </tr>
        <?php foreach($tables as $table): ?>
          <tr>
            <td><?php echo $table['name'];?></td>
            <td><?php echo $table['time_block'];?></td>
            <td><?php echo $table['seats'];?></td>
          </tr>
        <?php endforeach;?>
      </table>
    <?php else : ?>
    NO TABLES
    <?php endif ?>
  </div>
</div>
<script>
$(document).ready(function(){
  $('.add-table').on('click', function(e){
    e.preventDefault();
    let t = {};
    t.event_id = $(this).data('eventid');
    t.room_id = $(this).data('roomid');
    t.name = $('.name').val();
    t.seats = $('.seats').val();
    t.time_block = $('.time-block').val();
    $.ajax({
      url: '/events/rooms/addTable',
      data : t,
      method : 'POST',
      success : function(res) {
        if(res == "success") {
          location.reload();
        }
      }
    })
  })
});
</script>