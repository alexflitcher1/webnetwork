<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = $user->firstname . " " . $user->lastname;
?>
<div class="flex column-direction profile">
  <div class="flex main-info">
    <div class="profile-img">
      <img src="<?=$user->img?>" alt="Profile image" id="profile-img">
    </div>
    <div class="flex column-direction profile-data">
      <div class="flex">
        <div class="profile-name">
          <?=$user->firstname?>
        </div>
        <div class="profile-family">
          <?=$user->lastname?>
        </div>
      </div>
      <div class="profile-birthday">
        <?=$userdata->birthday?>
      </div>
      <div class="profile-statustext">
        <?=$userdata->statustext?>
      </div>
    </div>
  </div>
  <div class="flex second-info column-direction">
    <div class="aboutself">
      <?=$userdata->aboutself?>
    </div>
    <div class="flex column-direction usernotices">
      <div class="un-posts">
        Посты
      </div>
      <?php for ($i = 0; $i < count($posts); $i++): ?>
        <div class="post flex column-direction">
          <div class="un-time">
            <?=$posts[$i]['datepost']?>
          </div>
          <div class="un-post">
            <?=nl2br($posts[$i]['text'])?>
          </div>
        </div>
        <div class="un-comments">
          <?php
               for ($j = 0; $j < count($comments); $j++) {
                 if ($comments[$j]->postid == $posts[$i]->id) { ?>
                    <div class="un-time">
                      <?=$comments[$j]['datepub']?>
                    </div>
                    <div class="com-data">
                      <?=$commentators[$j]->firstname?>
                      <?=$commentators[$j]->lastname?>
                    </div>
                    <div class="com-text">
                      <?=nl2br($comments[$j]['comment'])?>
                    </div>
                 <?php } ?>
               <?php } ?>
        </div>
        <div class="un-add-com">
          <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model2, 'comment')->textarea() ?>
            <?= $form->field($model2, 'postid')->
            hiddenInput(['value'=> $posts[$i]['id']])->label(false); ?>
            <?= isset($error) ? $error : "" ?>
          <div class="form-group">
            <div>
              <?= Html::submitButton('Добавить',
                  ['class' => 'btn btn-success']) ?>
            </div>
          </div>
          <?php ActiveForm::end() ?>
        </div>
      <?php endfor; ?>
    </div>
  </div>
</div>
<?php
