<?php

$title = 'Teacher Timetable';
include_once(VIEW_PATH. 'layout/_timetableheader.php');
 ?>
 

<div id = "mainContent">

<?php if(empty($mon_records)&& empty($tue_records)&& empty($wed_records)&& empty($thur_records)&& empty($fri_records)):?>
 
<div id="emptyTimetable">

<h3 class="editTitle">No Timetable Found for <?php echo ucwords(strtolower($staff->full_name)); ?></h3>

</div>

<?php else:?>


<h3 class="editTitle"><?php echo htmlspecialchars(ucwords(strtolower($staff->full_name)));?>'s Period Schedule</h3>
<table id = "teacher">

<thead>

<tr>
<th>Period Title</th>
<th>Start Time</th>
<th>End Time</th>
<th>Class Title</th>
</tr>
</thead>
<tbody>
<tr class="break"> 
<td colspan="4"> Mondays</td>
</tr>
<?php if(!empty($mon_records)):?>
<?php foreach($mon_records as $mon_record): ?>
<tr>
<td><?php echo htmlspecialchars(strtoupper($mon_record['period_title'])); ?></td>
<td><?php echo $mon_record['start_time']; ?></td>
<td><?php echo $mon_record['end_time']; ?></td>
<td><?php echo strtoupper($mon_record['title']); ?></td>
</tr>
<?php endforeach;?>
<?php endif;?>

<tr class="break"> 
<td colspan="4">Tuesdays</td>
</tr>
<?php if(!empty($tue_records)):?>
<?php foreach($tue_records as $tue_record): ?>
<tr>
<td><?php echo htmlspecialchars(strtoupper($tue_record['period_title'])); ?></td>
<td><?php echo $tue_record['start_time']; ?></td>
<td><?php echo $tue_record['end_time']; ?></td>
<td><?php echo strtoupper($tue_record['title']); ?></td>
</tr>
<?php endforeach;?>
<?php endif;?>
<tr class="break"> 
<td colspan="4">Wednesdays</td>
</tr>
<?php if(!empty($wed_records)):?>
<?php foreach($wed_records as $wed_record): ?>
<tr>
<td><?php echo htmlspecialchars(strtoupper($wed_record['period_title'])); ?></td>
<td><?php echo $wed_record['start_time']; ?></td>
<td><?php echo $wed_record['end_time']; ?></td>
<td><?php echo strtoupper($wed_record['title']); ?></td>
</tr>
<?php endforeach;?>
<?php endif; ?>
<tr class="break"> 
<td colspan="4">Thursdays</td>
</tr>
<?php if(!empty($thur_records)):?>
<?php foreach($thur_records as $thur_record): ?>
<tr>
<td><?php echo htmlspecialchars(strtoupper($thur_record['period_title'])); ?></td>
<td><?php echo $thur_record['start_time']; ?></td>
<td><?php echo $thur_record['end_time']; ?></td>
<td><?php echo strtoupper($thur_record['title']); ?></td>
</tr>
<?php endforeach;?>
<?php endif;?>
<tr class="break"> 
<td colspan="4">Fridays</td>
</tr>
<?php if(!empty($fri_records)):?>
<?php foreach($fri_records as $fri_record): ?>
<tr>
<td><?php echo htmlspecialchars(strtoupper($fri_record['period_title'])); ?></td>
<td><?php echo $fri_record['start_time']; ?></td>
<td><?php echo $fri_record['end_time']; ?></td>
<td><?php echo strtoupper($fri_record['title']); ?></td>
</tr>
<?php endforeach;?>
<?php endif?>
</tbody>
</table>

<?php endif;?>

<a href="javascript:window.print()" class="print">Print</a>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php');?>