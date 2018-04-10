<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>


  <main class="content content-dark">
    <div class="container">


      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row btn-list-row block-15">
              <div class="col-sm-6">
                <a class="button-large bg-rouge" href="<?php echo base_url('/entry')?>">新規お申し込み</a>
              </div>
              <div class="col-sm-6">
                <a class="button-large bg-midnight-Blue" href="<?php echo base_url('admin/entry')?>">新入会員の皆様へ</a>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="form-search mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="rounded-corners-1 pb-10">
              <form action="<?php echo base_url(); ?>admin/member" method="POST">

                <div class="row">
                  <div class="col-sm-5 align-center mb-5">
                    <table width="100%">
                      <tr>
                        <td><img src="/images/hanamigawasw/icon_magnifying_glass.svg" style="width:35px"></td>
                        <td><input class="form-control" id = "text_condition" type="text" name="text_condition" placeholder="氏名・番号・学校名等"></td>
                      </tr>
                    </table>
                  </div>
                  <div class="col-sm-5 align-center mb-5">
                    <select class="form-control" name="type_condition">
                      <?php foreach ($type_search as $key_select => $value_select) {?>
                        <option value="<?php echo $key_select;?>"><?php echo $value_select;?></option>
                      <?php }?>
                    </select>
                  </div>
                  <div class="col-sm-2 align-center mb-5">
                    <input class="submit-btn bg-blue-green" id="search_member" type="submit" value="会員検索">
                  </div>
                </div>

              </form>
            </div>
          </div>
        </div>
      </section>


      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row btn-list-row block-15">
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 lead-heading-icon-men bg-blue-green" href="<?php echo base_url('/admin/member')?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>会員一覧</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 lead-heading-icon-mail bg-yellow" href="<?php echo base_url('/admin/reschedule')?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>欠席・振替<br>申請一覧</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-memo-2 bg-violet" href="<?php echo base_url('/admin/request')?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>契約変更<br>申請一覧</span>
                    </span>
                  </div>
                </a>
              </div>
              <!--
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-iccard bg-yellow-green" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>ICカード<br>入退室管理</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-calender-2 bg-carnation-pink" >
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>レッスン<br>出欠管理</span>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-4">
                <a class="btn-icon btn-icon-2 btn-icon-bus-02 bg-deep-green" href="<?php echo base_url('/admin/bus_route')?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>送迎バス<br>乗降管理</span>
                    </span>
                  </div>
                </a>
              </div>
              -->
            </div>
          </div>
        </div>
      </section>


      <section class="button-type-1">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="row">
              <div class="col-sm-4 button-type-1-box">
                <a href="<?php echo base_url('/admin/notice')?>">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="<?php echo base_url('/admin/calender')?>">カレンダー管理</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="<?php echo base_url('/admin/course')?>">マスターデータ管理</a>
              </div>
              <!--
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              <div class="col-sm-4 button-type-1-box">
                <a href="">マイページお知らせ設定</a>
              </div>
              -->
            </div>
          </div>
        </div>
      </section><!-- .button-type-1 -->




      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">本日の初日会員一覧（<?php if(isset($list_member_today)){ $tmp_cnt = count($list_member_today); echo $tmp_cnt;}?>名）</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">コース</th>
                        <th class="bg-sirahuji text-gray">クラス</th>
                        <th class="bg-sirahuji text-gray">コーチへの連絡事項</th>
                        <th class="bg-sirahuji text-gray">泳力<br>アンケート</th>
                        <th class="bg-sirahuji text-gray"></th>
                      </tr>
                    </thead>
                    <tbody>
                      
                      <?php if(!empty($list_member_today)){?>
                        <?php foreach ($list_member_today as $key_mbt => $value_mbt) {?>
                          <tr>
                            <td><?php echo  $value_mbt['id'];?></td>
                            <td><?php echo  $value_mbt['name'];?></td>
                            <td><?php echo  $value_mbt['course_name'];?></td>
                            <td><?php echo  $value_mbt['class_name'];?></td>
                            <td><?php echo  $value_mbt['memo_to_coach'];?></td>
                            <td class="align-left">
                            <?php 
                              $tmp_json = json_decode($value_mbt['enquete'], true);
                              $strg = '';
                              $strg .= '<ul>';
                                $strg .= '<li>' . $tmp_json['face_into_water'] == '1' ? '水に顔をつけることができない' : '水に顔をつけることができる'.'</li>';
                                $strg .= '<li>' . $tmp_json['dive'] == '1' ? '潜れる' : '潜れない'.'</li>';
                                $strg .= '<li>' . $tmp_json['float'] == '1' ? '浮かべる' : '浮かべない'.'</li>';
                                $strg .= '<li> バタ足 :' . $tmp_json['style']['flutter_kick'] .'</li>';
                                $strg .= '<li> 板キック :' . $tmp_json['style']['board_kick'] .'</li>';
                                $strg .= '<li> 背泳ぎ :' . $tmp_json['style']['backstroke'] .'</li>';
                                $strg .= '<li> クロール :' . $tmp_json['style']['crawl'] .'</li>';
                                $strg .= '<li> 平泳ぎ :' . $tmp_json['style']['breast_stroke'] .'</li>';
                                $strg .= '<li> バタフライ :' . $tmp_json['style']['butterfly'] .'</li>';
                                $strg .= '<li> 備考 :' . $tmp_json['style']['note'] .'</li>';
                                
                                $strg .= '<li>' . $tmp_json['free_lesson'] == '1' ? '無料体験に参加したことがあります。' : '無料体験に参加したことがありません。'.'</li>';
                                $strg .= '<li>' . $tmp_json['short_lesson'] == '1' ? '短期水泳教室に参加したことがあります。' : '短期水泳教室に参加したことがありません。'.'</li>';
                                $strg .= '<li>' . $tmp_json['experience']['status'] == '1' ? '当クラブまたは他クラブに通っていたことがあります。' : '当クラブまたは他クラブに通っていたことがありません。'.'</li>';
                              $strg .= '</ul>';
                              echo $strg;
                            ?>
                            <td>
                              <div class="block-30 text-center">
                                <a href="<?php echo base_url('/admin/member/detail/'.$value_mbt['id']);?>" class="btn btn-default btn-long">
                                  <span>確認</span>
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php } ?>
                        <?php } else {?>
                        <tr>
                          <td>
                            <td colspan = 7 center>データがありません。</td>
                          </td>
                        </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">本日の無料体験者一覧（<?php if(!empty($member_course_free[1])){echo $member_course_free[1];}else{ echo 0;}?>名）</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">コース</th>
                        <th class="bg-sirahuji text-gray">クラス</th>
                        <th class="bg-sirahuji text-gray">コーチへの連絡事項</th>
                        <th class="bg-sirahuji text-gray">泳力<br>アンケート</th>
                        <th class="bg-sirahuji text-gray"></th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php if(!empty($member_course_free[0])){ ?>
                      <?php foreach ($member_course_free[0] as $key_cf => $value_cf) { ?>      
                        <tr>
                          <td><?php echo $value_cf['student_id'];?></td>
                          <td><?php echo $value_cf['name'];?></td>
                          <td><?php echo $value_cf['course_name'];?></td>
                          <td><?php echo $value_cf['base_class_sign'];?></td>
                          <td><?php echo $value_cf['school_name'].'/'.$value_cf['school_grade'];?></td>
                          <!-- <td><?php //echo $value_cf['memo_health'];?></td> -->
                          <td class="align-left"><?php echo $value_cf['enquete'];?></td>
                          <td>
                            <div class="block-30 text-center">
                              <a target ="blank" href="<?php echo base_url('/admin/member/edit/'.$value_cf['student_id']);?>" class="btn btn-default">
                                <span>確認</span>
                              </a>
                            </div>
                          </td>
                        </tr>
                      <?php }?>
                      <?php } else {?>
                        <tr>
                          <td>
                            <td colspan = 7 center>データがありません。</td>
                          </td>
                        </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-carnation-pink align-left pl-30">開催中の短期水泳教室</div>
              <div class="panel-body pl-30 pr-30 pt-10 pb-10">
                <div class="table-responsive">
                  <table width="100%" class="">
                    <tbody>
                      <?php if(!empty($db_course_short_term)){?>
                        <?php foreach ($db_course_short_term as $key_st => $value_st) {?>
                          <tr>
                            <td class="align-left"><?php echo $value_st['course_name'];?>（<?php echo $value_st['regist_start_date'];?> ～ <?php echo $value_st['regist_start_date'];?> ）</td>
                            <td class="align-right">
                              <a href="<?php echo base_url('/admin/member')?>" class="btn btn-default btn-long border-radius-0">
                                <span>会員一覧</span>
                              </a>　
                              <a href="#0" class="btn btn-default btn-long border-radius-0">
                                <span>出欠管理</span>
                              </a>
                            </td>
                          </tr>
                        <?php } ?>
                        
                      <?php } else {?>
                        <tr>
                          <td>
                            <td colspan = 3 center>データがありません。</td>
                          </td>
                        </tr>
                      <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <!--
      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">バス乗降変更連絡</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1 bg-plae-lemmon text-gray">
                    <tbody>
                      <tr>
                        <td class="">12345</td>
                        <td class="">2017/09/01</td>
                        <td class="">玉葱　太郎</td>
                        <td class="">一般</td>
                        <td class="align-right">
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                            <span>確認</span>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>



      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">2週間連絡のない会員</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-lg table-center table-border-1 bg-plae-lemmon text-gray">
                    <tbody>
                      <tr>
                        <td class="">12345</td>
                        <td class="">2017/09/01</td>
                        <td class="">玉葱　太郎</td>
                        <td class="">一般</td>
                        <td class="align-right">
                          <a href="#0" class="btn bg-wasatch-front btn-lg btn-long">
                            <span>確認</span>
                          </a>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      -->

      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">新規ネット申し込み（未処理）一覧</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-border-1 table-lg table-center">
                    <?php if(!empty($student_register)){?>
                      <?php foreach ($student_register as $key_str => $value_str) { ?>
                        <tr>
                          <td><?php echo $value_str['id'];?></td>
                          <td><?php echo $value_str['date_register'];?></td>
                          <td><?php echo $value_str['tag_name'];?></td>
                          <td><?php echo $value_str['course_name'];?></td>
                          <td><?php echo $value_str['tag_type_course'];?></td>
                          <td class="align-center">
                            <a target ="blank" href="<?php echo base_url('admin/entry/edit/'.$value_str['id']);?>" class="btn btn-default">
                              <span>処理</span>
                            </a>
                          </td>
                        </tr>
                      <?php }?>
                      <?php } else {?>
                        <tr>
                          <td>
                            <td colspan = 6 center>データがありません。</td>
                          </td>
                        </tr>
                      <?php }?>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


      <section class="mb-30">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">
            <div class="panel panel-card">
              <div class="panel-heading bg-blue-green align-left pl-30">契約変更申請（未処理）一覧</div>
              <div class="panel-body pl-30 pr-30 pt-30 pb-10">
                <div class="table-responsive">
                  <table class="table table-border-1 table-lg table-center">
                    <thead>
                      <tr>
                        <th class="bg-sirahuji text-gray">会員番号</th>
                        <th class="bg-sirahuji text-gray">氏名</th>
                        <th class="bg-sirahuji text-gray">申請日</th>
                        <th class="bg-sirahuji text-gray">申請内容</th>
                        <th class="bg-sirahuji text-gray">処理状況</th>
                        <th class="bg-sirahuji text-gray">処理日</th>
                        <th class="bg-sirahuji text-gray">手数料</th>
                        <th class="bg-sirahuji text-gray">　</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if(!empty($student_request[0])){?>
                        <?php foreach ($student_request[0] as $key_rq => $value_rq) {?>
                          
                          <tr>
                            <td><?php echo $value_rq['student_id'];?></td>
                            <td><?php echo $value_rq['name'];?></td>
                            <td><?php echo date('Y-m-d',strtotime($value_rq['create_date']));?></td>
                            <td><?php 
                              switch ($value_rq['type'])
                              {
                                  case 'bus_change_once':
                                      $value_rq['type']='バス乗降連絡';
                                      break;
                                  case 'bus_change_eternal':
                                      $value_rq['type']='バスコース変更';
                                      break;
                                  case 'course_change':
                                      $value_rq['type']='練習コース変更';
                                      break;
                                  case 'recess':
                                      $value_rq['type']='休会届';
                                      break;
                                  case 'quit':
                                      $value_rq['type']='退会届';
                                      break;
                                  case 'event_entry':
                                      $value_rq['type']='イベント・短期教室参加申請';
                                      break;
                                  case 'address_change':
                                      $value_rq['type']='住所変更申請 ';
                                      break;
                                  case 'change_base_info':
                                      $value_rq['type']='基本情報変更';
                                      break;
                              }
                              echo $value_rq['type'];
                            ?></td>
                            <td><?php 
                              switch ($value_rq['status'])
                              {
                                  case '0':
                                      $value_rq['status']='未処理/未確認';
                                      break;
                                  case '1':
                                      $value_rq['status']='承認/処理済み/確認済み';
                                      break;
                                  case '2':
                                      $value_rq['status']='保留';
                                      break;
                              }
                              echo $value_rq['status'];
                            ?></td>
                            <td>
                              <?php 
                                if ($value_rq['process_date']==NULL)
                                {
                                    $value_rq['process_date']='---';
                                }
                                else
                                {
                                    $value_rq['process_date'] = date('Y-m-d', strtotime($value_rq['process_date']));
                                }
                                
                                echo $value_rq['process_date'];
                              ?>
                            </td>
                            <td>
                                <?php 
                                  switch ($value_rq['comission_flg'])
                                  {
                                      case '0':
                                          $value_rq['comission_flg']='無';
                                          break;
                                      case '1':
                                          $value_rq['comission_flg']='手数料発生';
                                          break;
                                      case '2': $value_rq['comission_flg']='免除';
                                          break;
                                  }
                                  echo $value_rq['comission_flg'];
                                ?>
                            </td>
                            <td class="align-center">
                              <a target ="blank" href="<?php echo base_url('admin/member/detail/'.$value_rq['student_id']);?>" class="btn btn-default">
                                <span>処理</span>
                              </a>
                            </td>
                          </tr>
                        <?php }?>
                        <?php } else {?>
                          <tr>
                            <td>
                              <td colspan = 8 center>データがありません。</td>
                            </td>
                          </tr>
                        <?php }?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>


    </div>
  </main>
  <?php require_once("contents_footer.php"); ?>
  <script>
  </script>
</body>

</html>
