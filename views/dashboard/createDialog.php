<?php
$competitor = Competitor::model()->findByPk($model->comp_id);
$event = Event::model()->findByPk($model->evnt_id); 
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
                'id'=>'scoreDialog',
                'options'=>array(
                    'title'=>$event->evnt_name.' - '.$competitor->comp_name.' #'.$competitor->comp_bib,
                    'autoOpen'=>true,
                    'modal'=>'true',
                    'width'=>'300px',
                    'height'=>'auto',
                ),
                ));
	echo $this->renderPartial('_formDialog', array('model'=>$model,'evnt_type'=>$evnt_type)); ?>                
<?php $this->endWidget('zii.widgets.jui.CJuiDialog');?>