
<div class="review_div_holder">
	<div class="body_title_head">
		<h2 class="pull-left"><?= Yii::t('app', 'Reviews') ?></h2>
		<div class="pull-right"><a href="<?=Yii::$app->getUrlManager()->createUrl('/user/my-reviews')?>" class="btn btn_success_small">
			<?=Yii::t('app' , 'View All')?>
			</a></div>
		<div class="clear"></div>
		<?php
        $reviews = common\models\Feedback::find()->where(['feedback_to' => $model->id , 'status' => 1])->limit(3)->all();
        if (!empty($reviews)) :
            foreach ($reviews as $review) :
            
                ?>
		<div class="review_div_holder_inn">
			<p>
				<?=$review->message?>
			</p>
			<div class="review_footer">
				<div class="row">
					<div class="col-md-7">
						<?=Yii::t('app' , 'Posted by')?>
						<a href="#">
						<?=$review->feedbackFrom->fullName?>
						</a>
						<?=Yii::t('app' , 'on')?>
						<a href="#">
						<?=  \frontend\models\Common::date('dS M, Y' , $review->created_at)?>
						</a></div>
					<div class="col-md-5 rating_div text-right"><?=Yii::t('app' , 'Rating:')?>
						<?php
            echo kartik\widgets\StarRating::widget([
                'name' => 'userRating',
                'value' => $review->userRating,
                'pluginOptions' => [
                    'readonly' => true,
                    'showClear' => false,
                    'showCaption' => false,
                    'size' => 'xs'
                ],
            ]);
            ?>
					</div>
				</div>
			</div>
		</div>
		<?php
            endforeach;
        else:
            ?>
		<div class="review_div_holder_inn">
			<p>
				<?= Yii::t('app', "No reviews to show") ?>
			</p>
		</div>
		<?php endif; ?>
	</div>
</div>
