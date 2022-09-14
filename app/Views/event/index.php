
<div class="row">
  <div class="col-md-12">
    <h2><?= esc($title) ?></h2>
        <div class="row">
          <div class="col-md-2">
            <label>Name<br>
            <input type="text" class="name form-control">
          </div>
        </div>
        <a href="" class="btn btn-primary" data-id="<?php echo $event['id'];?>">Add Event</a>
        <hr>
    <?php if (! empty($events) && is_array($events)) : ?>
      <ul>
      <?php foreach ($events as $event): ?>
        <li><?= $event['name']; ?> <a href="/events/library/<?= $event['id']; ?>">Library </a> | <a href="/events/cico/<?= $event['id']; ?>">Checkin/Checkout</a> | <a href="/events/calendar/<?= $event['id']; ?>">Calendar Set Up</a> | <a href="/events/rooms/<?= $event['id']; ?>">Room Management</a> | <a href="/schedule/<?= $event['id']; ?>">Schedule</a></li>
      <?php endforeach;?>
      </ul>
    <?php else : ?>
    NO EVENTS
    <?php endif ?>
  </div>
</div>
<script>
$(document).ready(function(){
  $('.btn').on('click', function(e){
    e.preventDefault();
    let t = {};
    t.event_id = $(this).data('id');
    t.name = $('.name').val();

    $.ajax({
      url: '/events/addEvent',
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
