<?php 

$title = 'Show Payments';
include_once(VIEW_PATH. 'layout/_header.php');

?>

<?php include_once(VIEW_PATH. 'layout/Principal/_nav.php'); ?>

<div id = "mainContent" style="height: 32em;">

<?php if(!empty($payments)):?>
<h3 class="paymentTitle">Payment Details for <?php echo ucwords($std_name->surname . '  '. $std_name->first_name);?></h3>
<div id="navLinks">
<?php if($pagination->total_pages()>1){
   
    if($pagination->has_prev()){
    
    echo '<p><a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'payments/show?id='.$std_name->id.'&page='. $pagination->prev_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/previous.png /></a>';
    echo '&nbsp&nbsp&nbsp&nbsp';
    }else{echo '<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'; }
    if($pagination->has_next()){
    echo '<a class = "navLinks" href ='. '/'. APP_ROOT.'/'.'payments/show?id='.$std_name->id.'&page='. $pagination->next_page(). '><img src ='. WEBSITE.DS. APP_ROOT.DS. 'images/next.png /></a></p>';
    
    }else{echo '&nbsp&nbsp&nbsp&nbsp&nbsp</p>'; }

} 
?>

</div>
<div class="viewPaymentMsg"><?php echo flash_message($session->get_message());?></div>


<form action="">
<?php foreach($payments as $payment):?>

<fieldset class = "payment" > 
<legend>Payment Details</legend>

<p><label>Term</label><input type="text" value="<?php echo strtoupper($payment->term);?>" disabled="disabled" /></p>
<p><label>Amount Paid(NGN)</label><input type="text" name="payments[amount_paid]" value="<?php echo number_format($payment->amount_paid, 2); ?>" disabled="disabled" /></p>
<p><label>Amount Due(NGN)</label><input type="text" name="payments[amount_due]" value="<?php echo  number_format($payment->amount_due, 2);?>" disabled="disabled" /></p>

<p><label>Teller/Trans No.</label><input name="payments[teller_no]" type="text" value="<?php echo $payment->teller_number;?>" disabled="disabled" /></p>

<p><label>Date</label><input type="text" name="payments[date]" value="<?php echo displayed_date($payment->date);?>" disabled="disabled" /></p>
<p><label>Remarks</label><textarea name="payments[remark]" cols="25" rows="3" disabled="disabled"><?php echo $payment->remarks;?></textarea></p>

</fieldset>

<?php endforeach;?>
</form>
<?php else:?>
<div id="emptyResult">
<h3 class="title"> No Payment Record Found!</h3>
</div>
<?php endif;?>
</div>



<?php

include_once(VIEW_PATH. '/layout/_footer.php');

?>