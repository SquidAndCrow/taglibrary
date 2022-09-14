
<div class="row">
  <div class="col-md-12">
    <h2 style="margin-top: 1em;"><?php echo $event['name'];?> Calendar</h2>
    <div class="row">
      <div class="col-md-2">
        <label>Name<br>
        <input type="text" class="name form-control">
      </div>
      <div class="col-md-2">
        <label>Date<br>
        <input type="text" class="datepicker form-control">
      </div>
      <div class="col-md-2">
        <label>Start Time<br>
        <input type="time" class="start-time form-control" placeholder="hh:mm">
      </div>
      <div class="col-md-2">
        <label>End Time<br>
        <input type="time" class="end-time form-control" placeholder="hh:mm">
      </div>
      <div class="col-md-2">
        <label>Public Start Time<br>
        <input type="time" class="public-start-time form-control" placeholder="hh:mm">
      </div>
      <div class="col-md-2">
        <label>Public End Time<br>
        <input type="time" class="public-end-time form-control" placeholder="hh:mm">
      </div>
    </div>
    <a href="" class="btn btn-primary" data-id="<?php echo $event['id'];?>">Add Day</a>
  </div>
</div>
<div class="row" style="margin-top: 1em;">
  <div class="col-md-12">
    <?php if (! empty($calendar) && is_array($calendar)) : ?>
      <table class="table striped">
        <tr>
          <th>Name</th>
          <th>Date</th>
          <th>Start Time</th>
          <th>End Time</th>
          <th>Public Start Time</th>
          <th>Public End Time</th>
        </tr>
        <?php foreach($calendar as $day): ?>
          <tr>
            <td><?php echo $day['name'];?></td>
            <td><?php $timestamp = strtotime($day['date']); $new_date = date("m-d-Y", $timestamp); echo $new_date; ?></td>
            <td><?php echo $day['startTime'];?></td>
            <td><?php echo $day['endTime'];?></td>
            <td><?php echo $day['publicStartTime'];?></td>
            <td><?php echo $day['publicEndTime'];?></td>
          </tr>
        <?php endforeach;?>
      </table>
    <?php else : ?>
    NO DATES
    <?php endif ?>
  </div>
</div>
<script src='/js/filter.js'></script>
<script>
$(document).ready(function(){
  $('.datepicker').datepicker();
  $('.btn').on('click', function(e){
    e.preventDefault();
    let t = {};
    t.event_id = $(this).data('id');
    t.name = $('.name').val();
    t.date = $('.datepicker').val();
    t.startTime = $('.start-time').val();
    t.endTime = $('.end-time').val();
    t.publicEndTime = $('.public-end-time').val();
    t.publicStartTime = $('.public-start-time').val();

    $.ajax({
      url: '/events/calendar/addDay',
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