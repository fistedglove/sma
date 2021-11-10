<?php 

$title = 'First Term Result';
include_once(VIEW_PATH. 'layout/_resultheader.php');

?>



<div id = "mainContent">
<div id="resultMessage"><?php echo flash_message($session->get_message());?></div>
<?php if (!empty($record)):?>

<div id = "resultHeading">
<div class = "stDetails1">

<p><span>Student Name:  </span><?php echo strtoupper($record[0]['surname']). '   '. strtoupper($record[0]['first_name']);?></p>
<p><span>Class:  </span><?php echo strtoupper($record[0]['title']);?></p>

</div>
<div class="stDetails2">
<p><span>House:  </span><?php echo strtoupper($record[0]['house_title']);?></p>
<p><span>Days in School:  </span><?php echo $record[0]['attendance']?></p>
</div>
<div class="stDetails3">
<p><span>Academic Session:  </span><?php echo ACADEMIC_YEAR;?></p>
<p><span>Academic Term:  </span>First Term</p>
</div>
</div>
<br class="clear" />

<div id = "result">
<table class="report" >
<thead>
<tr>
<th>Subjects</th>
<th class="score">Test Score<br />(40%)</th>
<th class="score">Exam Score<br />(60%)</th>
<th class="score">Total Score<br />(100%)</th>
<th class="score">Grade</th>
<th class="score">Effort</th>
<th>Teacher's Comment</th>
</tr>
</thead>
<tbody>
<?php foreach($record as $score): ?>
<tr>
<td><?php echo ucwords($score['subject_name']); ?></td>
<td class="score"><?php echo $score['test_score']; ?></td>
<td class="score"><?php echo $score['exam_score']; ?></td>
<td class="score"><?php echo $score['total_score']; ?></td>
<td class="score"><?php echo strtoupper($score['grade']); ?></td>
<td class="score"><?php echo strtoupper($score['effort']); ?></td>
<td><?php echo ucfirst($score['teacher_comment']); ?></td>
</tr>
<?php endforeach;?>
</tbody>
</table>

</div>
<p  class="teacher">Class Teacher's Comment</p>
<div class="comment">
<p><?php echo ucfirst($record[0]['remark']); ?></p>
</div>
<div class="principal">
<p>--------------------------------Date-----------<br /><span class="principal">Principal's Signature</span></p>
</div>
<div class="signature">
<p>-------------------------------<br /><span class="signature">Teacher's Signature</span></p>
</div>
<p class="dashed">----------------------------------------------------------------------------------------------------------------------------------------------------------</p>
<p class="declaration">Parent Declaration</p>
<div class="declaration">
<p>I -------------------------- the father/mother of <strong><?php echo ucwords($record[0]['surname']). '  '. ucwords($record[0]['first_name']); ?></strong> acknowledge that the original copy of the result was collected by me.</p>
</div>
<div class = "parent">
<p>-------------------------------Date-----------<br /><span class="signature">Parent Signature</span></p>

</div>

<?php else:?>
<div id="emptyResult">
<h3 style="height: 25em;">The First Term Scores for this student has not been entered</h3>
</div>
<?php endif;?>
<a href="javascript:window.print()" class="print">Print Result</a>
</div>

<?php include_once(VIEW_PATH. 'layout/_footer.php'); ?>
