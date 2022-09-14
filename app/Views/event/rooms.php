
<div class="row">
  <div class="col-md-12">
    <h2 style="margin-top: 1em;"><?php echo $event['name'];?> Rooms</h2>
    <div class="row">
      <div class="col-md-2">
        <label>Name<br>
        <input type="text" class="name form-control">
      </div>
    </div>
    <a href="" class="btn btn-primary add-room" data-id="<?php echo $event['id'];?>">Add Room</a>
  </div>
</div>
<div class="row" style="margin-top: 1em;">
  <div class="col-md-12">
    <?php if (! empty($rooms) && is_array($rooms)) : ?>
      <table class="table striped">
        <tr>
          <th style="width: 20%">Name</th>
          <th></th>
        </tr>
        <?php foreach($rooms as $room): ?>
          <tr>
            <td><?php echo $room['name'];?></td>
            <td><a href="/events/tables/<?php echo $event['id'];?>/<?php echo $room['id'];?>" class="btn btn-primary btn-xs">Manage Tables</a></td>
          </tr>
        <?php endforeach;?>
      </table>
    <?php else : ?>
    NO ROOMS
    <?php endif ?>
  </div>
</div>
<script>
$(document).ready(function(){
  $('.add-room').on('click', function(e){
    e.preventDefault();
    let t = {};
    t.event_id = $(this).data('id');
    t.name = $('.name').val();

    $.ajax({
      url: '/events/rooms/addRoom',
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