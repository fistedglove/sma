<?php

$title = 'Classes Timetable';

include_once(VIEW_PATH. 'layout/_timetableheader.php');
 ?>
 
 
 <div id ="mainContent">
  <?php if (!empty($records)): ?>

 <h3 class="editTitle">Timetable for class <?php echo strtoupper($class->title); ?></h3>
<div class="indexTimetableMsg" ><?php echo flash_message($session->get_message());?></div>

 <div>
 <table id ="classTimetable">
 <thead class="timetable_head">
 <tr class="timetable">
 <th>Period</th>
 <th>Start Time</th>
 <th>End Time</th>
 <th>Mondays</th>
 <th>Tuesdays</th>
 <th>Wednesdays</th>
 <th>Thursdays</th>
 <th>Fridays</th>
 </tr>
 </thead>
 <tbody class="timetable_body">
 <?php foreach($records as $record):?>
 <tr class="timetable_body">
 <?php $period_title = $record['period_title'];
       $result_set = $database->fetch_array($database->query("SELECT id FROM periods WHERE period_title ='$period_title'"));
       $period_id = $result_set['id'];
 ?>
            
 <td><a href="<?php echo '/'. APP_ROOT.'/';?>class_timetable/edit?id=<?php echo $id;?>&period=<?php echo $period_id;?>"><?php echo htmlspecialchars(strtoupper($record['period_title']));?></a></td>
 <td><?php echo htmlspecialchars(strtoupper($record['start_time']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['end_time']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['mon']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['tue']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['wed']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['thur']));?></td>
 <td><?php echo htmlspecialchars(strtoupper($record['fri']));?></td>
 </tr>
 <?php if ($record['period_title'] == 'Third'):?>
 <tr class="break">
 <td colspan="8" style="font-size:.8em;">SHORT BREAK<br />(10:20 AM - 10:40 AM)</td>
 </tr>
 <?php endif;?>
 <?php if ($record['period_title'] == 'Sixth'):?>
 <tr class="break">
 <td colspan="8" style="font-size: .8em;">LUNCH BREAK<br />(12:40 PM - 1:10 PM)</td>
 </tr>
 <?php endif;?>
 <?php endforeach;?>
 </tbody>
 
 
 </table>
 
 </div>
 
 <?php else:?>
 <div id="emptyResult">
 <h3>No Timetable Found!</h3>
 </div>
 <?php endif;?>
 
<a href="javascript:window.print()" class="print">Print</a>
 </div>

 <?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>