<!DOCTYPE html>
<html lang="ja">
<head>
  <?php require_once("head.php"); ?>
  <script>
    function get_define(){
            ABSENCE = "<?php echo ABSENCE; ?>",
            TRANSFER = "<?php echo TRANSFER; ?>",
            ABSENCE_TRANSFER = "<?php echo ABSENCE_TRANSFER; ?>",
            ABSENCE_CANCELED = "<?php echo ABSENCE_CANCELED; ?>",
            TRANSFER_CANCELLATION = "<?php echo TRANSFER_CANCELLATION; ?>",
            ABSENCE_TRANSFER_CANCELLATION = "<?php echo ABSENCE_TRANSFER_CANCELLATION; ?>",
            REGISTED_REST = "<?php echo REGISTED_REST; ?>",
            REGISTED_TRANSFER = "<?php echo REGISTED_TRANSFER; ?>",
            MONDAY = "<?php echo EVERY_MONDAY; ?>",
            TUESDAY = "<?php echo EVERY_TUESDAY; ?>",
            WENDAY = "<?php echo EVERY_WENDAY; ?>",
            THUSDAY = "<?php echo EVERY_THUSDAY; ?>",
            FRIDAY = "<?php echo EVERY_FRIDAY; ?>",
            SATUDAY = "<?php echo EVERY_SATUDAY; ?>",
            SUNDAY = "<?php echo EVERY_SUNDAY; ?>",
            DATE_TEST = "<?php echo DATE_TEST; ?>",
            DATE_CLOSED = "<?php echo DATE_CLOSED; ?>",
            PERMISSION_DATE = "<?php echo PERMISSION_DATE; ?>",
            //通常出席予定日
            REGISTED_PRESENCE_PLAN = "<?php echo REGISTED_PRESENCE_PLAN; ?>";
            
    }
  </script>
  <!-- 欠席･振替申請画面JS -->
  <script src="/js/hanamigawasw/reschedule.js"></script>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">
      <h1 class="lead-heading lead-heading-icon-calender bg-main h3">欠席･振替申請</h1>
      <section>
        <div class="panel panel-dotted">
          <div class="panel-heading">
            <?php if (!empty($course)) {
              foreach ($course as $key => $value) {
                echo $value['course_name'];
              }
            }?>
          </div>
          <div class="panel-body">

            <div class="block-30" id="waring-msg">
              <div class="alert alert-danger text-center text-block">
                <span><i class="fa fa-info-circle fix-left-reschedule" aria-hidden="true"></i><span>
                <!-- <span><i class="fa fa-info-circle" aria-hidden="true"></i> 13日のCクラスは定員オーバーのため振替できません。</span>
                <span><i class="fa fa-info-circle" aria-hidden="true"></i> 無連絡欠席日があります。お休み申請しないと振替できません。</span> -->
              </div>
            </div>

            <div class="block-15">
              <div id='calendar_recheduce'></div>
            </div>

            <div class="text-center">
              <p class="block-15">
                <span class="label label-danger label-lg">あと 1 回振替できます。</span>
              </p>
              <p class="text-break">
                <span>振替日を</span>
                <span class="label label-outline-blue">振替可能</span>
                <span>の中からタップしてください。</span>
              </p>
              <p class="block-15 text-break">
                <span>出席予定日をお休みする際は</span>
                <span>日付をタップしてください。</span>
              </p>
            </div>
          </div>
        </div>
      </section>
      <?php
      /*
       * Bootstrapのモーダル表示を使用
       * 
       * data-target="#modal_transfer"　で
       * 
       * モーダル#modal_transferがshowされる
       */
      ?>
      <div class="container">
        <h5>
          <small><i class="fa fa-info-circle" aria-hidden="true"></i> 以下モーダル表示サンプルです。</small>
        </h5>
        <ul>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal_transfer">P2: お休み／振替予定設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalCompleteOyasumi">P2: おやすみにしました</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalCompleteFurikae">P2: 振替日を設定しました</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal_transfer2">P3: 振替予定設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal_transfer_cancel">P4: 振替キャンセル設定</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancelDone">P4: 振替キャンセル設定（完了）</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modal_rest_cancel">P5: 振替キャンセル設定（休みをキャンセルして通常通り出席する）</button>
          </li>
          <li>
            <button type="button" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalFurikaeCancelDone2">P5: 振替キャンセル設定（休み予定をキャンセルしました。）</button>
          </li>
          
        </ul>
      </div>
      
      
      <!-- お休み／振替予定設定 モーダル実態 -->
      <!-- Modal: お休み／振替予定設定 -->
      <section class="modal fade" id="modal_transfer" role="dialog" >
        <div class="modal-dialog" >
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">お休み &frasl; 振替予定設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong class = "date-select-tmp">
                  <!-- name coure + class + time -->
                </strong>
              </h5>
              <hr class="hr-dashed">
              <form class="form-horizontal">
                <!-- chọn ngày  -->
                <!-- <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替日</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">あとで決める</option>
                    </select>
                  </div>
                </div> -->

                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">時間</label>
                  <div class="col-sm-7">
                    <select class="form-control" id = "fill_select_time">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替テスト</label>
                  <div class="col-sm-7">
                    <select class="form-control" id = "list_examp">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">送迎バス</label>
                  <div class="col-sm-7">
                    <select class="form-control" id="list_bus">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">理由</label>
                  <div class="col-sm-7">
                    <select class="form-control" id = "list_rest_reason">
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">理由</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3" id = "text_reason"></textarea>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" id = "request_reason" data-dismiss="modal"  data-toggle="modal" data-target="#modalCompleteOyasumi"  class="btn btn-info btn-block">お休みする</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Modal: お休みにしました -->
      <!-- <section class="modal fade" id="modalCompleteOyasumi" tabindex="-1" role="dialog" aria-labelledby="modalCompleteOyasumi">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>お休みにしました</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->

      <!-- Modal: 振替日を設定しました -->
      <!-- <section class="modal fade" id="modalCompleteFurikae" tabindex="-1" role="dialog" aria-labelledby="modalCompleteFurikae">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>振替日を設定しました</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section> -->

      <section class="modal fade" id="modalCompleteOyasumi" tabindex="-1" role="dialog" aria-labelledby="modalCompleteOyasumi">
        <div class="modal-dialog modal" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">お休み &frasl; 振替予定設定</h4>
            </div>
            <div class="modal-body">
                <div class="row"> 
                  <div class="col-sm-6 ">
                    <button type="button" class="btn btn-default btn-block" id = "send_register_rest" data-dismiss="modal">
                      <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                      <strong>お休みにしました</strong>
                    </button>
                  </div>
                  <div class="col-sm-6 ">
                    <button type="button" class="btn btn-default btn-block" id = "send_transfer" data-dismiss="modal">
                      <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                      <strong>振替日を設定しました</strong>
                    </button>
                  </div>
                </div>  
                
            </div>
          </div>
        </div>
      </section>



      <!-- Modal: P3 振替予定設定 -->
      <section class="modal fade" id="modal_transfer2" tabindex="-1" role="dialog" aria-labelledby="modal_transfer2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替予定設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>2017 年9 月27 日</strong>
              </h5>
              <hr class="hr-dashed">
              <form class="form-horizontal">
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">振替日</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">あとで決める</option>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <label for="" class="col-sm-3 control-label">時間</label>
                  <div class="col-sm-7">
                    <select class="form-control">
                      <option value="">C 15：15〜</option>
                    </select>
                  </div>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" class="btn btn-info btn-block">振替出席する</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P4 振替キャンセル設定 -->
      <section class="modal fade" id="modal_transfer_cancel" tabindex="-1" role="dialog" aria-labelledby="modal_transfer_cancel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong class="cancel_tran_date"></strong>
              </h5>
              <hr class="hr-dashed">
              <!-- <dl class="dl-horizontal">
                <dt>テスト</dt>
                <dd>受ける</dd>
              </dl> -->
              <input type = "hidden" class="id_tranfer" value = ""/>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" id = "" data-dismiss="modal" class="btn btn-info btn-block delete_tranfer">振替をキャンセルする</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!-- Modal: P4 振替キャンセル設定  振替予定をキャンセルしました -->
      <section class="modal fade" id="modalFurikaeCancelDone" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancelDone">
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>振替予定をキャンセルしました。</strong>
              </h5>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P5 振替キャンセル設定（休みをキャンセルして通常通り出席する） -->
      <section class="modal fade" id="modal_rest_cancel" tabindex="-1" role="dialog" aria-labelledby="modal_rest_cancel">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong class="cancel_rest_date"></strong>
              </h5>
              <input type = "hidden" class="id_rest" value = ""/>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-3">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
                <div class="col-sm-9">
                  <button type="button" data-dismiss="modal" class="btn delete_rest btn-info btn-block" >休みをキャンセルして通常通り出席する</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Modal: P5 振替キャンセル設定（休み予定をキャンセルしました。） -->
      <section class="modal fade" id="modalFurikaeCancelDone2" tabindex="-1" role="dialog" aria-labelledby="modalFurikaeCancelDone2">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header bg-blue text-center">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <h4 class="modal-title">振替キャンセル設定</h4>
            </div>
            <div class="modal-body">
              <h5 class="text-center">
                <strong>休み予定をキャンセルしました。</strong>
              </h5>
              <hr class="hr-dashed">
              <p class="text-center text-block">
                <span>2017 年9 月27 日 [C]15:55 ～</span>
                <span>の振替予定もキャンセルしました。</span>
              </p>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- dev TRI VV-JSC custome page-->
      
      <!-- <button id="show_list_select" type="button" style = "display:none" class="btn btn-link btn-sm" data-toggle="modal" data-target="#modalSelectOption">show list option</button> -->
      <section class="modal fade" id="modalSelectOption" role="dialog" aria-labelledby="modalSelectOption">
        <div class="modal-dialog modal">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong>LIST ACTION</strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  
                      <button type="button" id="show_modal_reg" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_transfer" data-dismiss="modal">お休み／振替予定設定</button>
                     
                      <button type="button" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_transfer2" data-dismiss="modal">振替予定設定</button>
                    
                      <button type="button" id ="btn_cancel_tranfer" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_transfer_cancel" data-dismiss="modal">振替キャンセル設定</button>
                    
                      <button type="button" id ="btn_cancel_rest" class="btn btn-default btn-block" data-toggle="modal" data-target="#modal_rest_cancel" data-dismiss="modal"> 振替キャンセル設定</button>
                     
                    <!-- <button type="button" class="btn btn-default btn-block" data-dismiss="modal">
                      <span aria-hidden="true">&times;</span>
                      <span></span>
                    </button>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- data hidden -->
          <div class="hidden-list-input">
            <?php if(!empty($course[0])){?>
              <input type="hidden" value = "<?php echo $course[0]['course_name'];?>" name = "course_current" id = "course_current">
            <?php }?>
            <?php if(!empty($student_class[0])){?>
              <input type="hidden" value = "<?php echo $student_class[0]['class_id'];?>" name = "class_id_current" id = "class_id_current">
              <input type="hidden" value = "<?php echo $student_class[0]['class_name'];?>" name = "class_name_current" id = "class_name_current">
            <?php }?>
          </div>
      <!-- end data hidden -->
      <!-- show alert -->
      <button type="button" style ="display: none" class="btn btn-default btn-block" data-toggle="modal" id = "btn_modal_show_alert" data-target="#modalShowAlert"></button>
      <section class="modal fade" id="modalShowAlert" role="dialog" aria-labelledby="modalShowAlert">
        <div class="modal-dialog modal" role="document">
          <div class="modal-content">
            <div class="modal-body">
              <h4 class="text-center">
                <i class="fa fa-info-circle text-primary" aria-hidden="true"></i>
                <strong class = "content_alert"></strong>
              </h4>
            </div>
            <div class="modal-footer">
              <div class="modal-btns row">
                <div class="col-sm-8 col-sm-offset-2">
                  <button type="button" class="btn btn-default btn-block edit_width_btn" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span>閉じる</span>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- end show alert -->
      <!-- end custome page -->
    </div>
  </main>
  <?php require_once("contents_footer.php"); ?>
</body>

</html>
