<?php

use yii\helpers\Html;
use \yii\widgets\LinkPager;
use frontend\models\Common;

$this->title = Yii::t('app', 'Reviews For ') . $user->fullName;
?>

<article class="inner_body">
	<div class="container">
		<?=
        $this->render(
                '//' . $user->profileType . '/_dashboard-left', ['model' => $user]
        )
        ?>
		<div class="col-md-9 col-sm-8 inner_body_part">
			<div class="review_div_holder">
				<div class="body_title_head">
					<?php
                    if (!empty($model)) :
                        foreach ($model as $review) :
                            ?>
					<div class="review_feedback">
						<div class="review_feedback_img"><img alt="0" src="<?= $review->feedbackFrom->profileImage ?>"></div>
						<div class="review_feedback_content">
							<div class="review_feedback_content_holder">
								<div class="feedback_text">
									<p>
										<?= $review->message ?>
									</p>
								</div>
								<div class="row">
									<p class="rating_div col-sm-5"><?= Yii::t('app', 'Rating:') ?>
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
									</p>
									<p class="col-sm-7 text-right">
										<?= Yii::t('app', 'Posted by') ?>
										<a href="#">
										<?= $review->feedbackFrom->fullName ?>
										</a>
										<?= Yii::t('app', 'on') ?>
										<a href="#">
										<?= \frontend\models\Common::date('dS M, Y', $review->created_at) ?>
										</a></p>
								</div>
							</div>
						</div>
						<div class="clear"></div>
					</div>
					<?php
                        endforeach;
                    else:
                        ?>
					<div class="review_feedback">
						<p>
							<center>
								<?= Yii::t('app', 'No reviews yet.') ?>
							</center>
						</p>
					</div>
					<?php endif; ?>
					<div class="message_pagination">
						<?=
                        LinkPager::widget([
                            'pagination' => $pages,
                        ]);
                        ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</article>
