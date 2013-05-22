<?php
echo $this->Html->script('jquery-1.8.2.min');
?>
<?php
//$this->Js->JqueryEngine->jQueryObject = '$j';
echo $this->Html->scriptBlock(
    '$(document).ready(function(){
		alert("sfsfsf");
    
		});',
    array('inline' => true)
);
?>
<div id="foo">sfsf</div>
<?php
$this->Js->get('#foo')->effect('fadeIn');
?>


