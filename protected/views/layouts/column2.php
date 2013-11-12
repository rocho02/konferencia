<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<div class="span-19">
	<div id="content">
		<?php echo $content; ?>
	</div><!-- content -->
</div>
<div class="span-5 last">
	<div id="sidebar">
	<?php
       $this->widget('zii.widgets.jui.CJuiDatePicker',array(
            'name'=>'publishDate',
            'flat'=>true,
            // additional javascript options for the date picker plugin
            'options'=>array(
                'showAnim'=>'fold',
            ),
            'htmlOptions'=>array(
                'style'=>' font-size: 8px; margin-bottom: 10px;'
            ),
        ));
        ?>
        <?php
    ?>
	<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
			'title'=> Yii::t('app','Operations'),
		));
		$this->widget('zii.widgets.CMenu', array(
			'items'=>$this->menu,
			'htmlOptions'=>array('class'=>'operations'),
		));
		$this->endWidget();
	?>
	</div><!-- sidebar -->
</div>
<?php $this->endContent(); ?>