<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <section>
        <div class="row">
          <div class="col-xs-6 text-break">
            <?php if(!empty($class_pass)){?>
              
              <span class="label label-info label-lg"><?php echo $name_class ?> 級</span>
              <span><strong><?php echo $class_pass['end_date']?> 合格</strong></span>
            <?php }else{?>
              <span><strong>Don't completed any class</strong></span>
            <?php }?>
          </div>
          <div class="col-xs-6 text-break">
            <span class="label label-success label-lg"><?php echo $time_join['long_time'];?></span>
            <?php if(!empty($time_join['date_stated'])){?>
              <span><strong>(<?php echo $time_join['date_stated'];?> 入会)</strong></span>
            <?php }?>
          </div>
        </div>
      </section>

      <section>
        <?php if(isset($message_nofication)){?>
        <div class="block-30" role="alert">
          <h2 class="h3 text-primary">お知らせ</h2>
          <p class="content03-text-2 mb-xs-30">
            <?php echo $message_nofication['body'];?>
          </p>
        </div>
        <div class="center-block text-center block-15">
          <div class="alert alert-warning text-center" role="alert">
            新しいメッセージがあります！
          </div>
        </div>
        <?php }?>

        <div class="alert alert-danger text-center" role="alert">
          <h3 class="lead">
            <strong>現在休会中です。</strong>
          </h3>
          <p>
            2017年11月1日より元の練習コースへ復帰します。
            <br> 休会を延長される場合は、再度休会申請を行ってください。
          </p>
        </div>
      </section>

      <section>
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1">

            <div class="row btn-list-row block-15">
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-calender bg-red" href="<?php echo base_url('/reschedule');?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>欠席・振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-swim bg-light-blue" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>出席記録</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-medal bg-yellow" href="#0">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>練習コース振替申請</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
              <div class="col-sm-6">
                <a class="btn-icon btn-icon-memo bg-green" href="<?php echo base_url('/request');?>">
                  <div class="btn-icon-inner" data-mh="btn-inner">
                    <span class="text-block">
                      <span>基本情報変更</span>
                      <small>Markup</small>
                    </span>
                  </div>
                </a>
              </div>
            </div>

            <p class="text-center">
              <a href="<?php echo base_url('/help')?>" class="btn btn-link">
                <i class="fa fa-info-circle" aria-hidden="true"></i>
                <span>ヘルプ・お困りのときはこちら</span>
              </a>
            </p>

          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-card">
          <div class="panel-heading bg-light-blue text-center">通学・練習コース出席記録</div>
          <div class="panel-body">

            <div class="row align-items-center">
              <div class="col-xs-6">
                <span>2017/09/01 18:32 現在</span>
              </div>
              <div class="col-xs-6 text-right">
                <button class="btn-reload"></button>
              </div>
            </div>

            <div class="row row-table-wrapper text-center">
              <div class="col-sm-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="bg-light-blue" colspan="2">行き</th>
                    </tr>
                  </thead>
                  <tbody data-mh="assign-table">
                    <tr>
                      <th>バス乗車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>バス降車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>入館</th>
                      <td>00:00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-4">
                <table class="table">
                  <thead>
                    <tr>
                      <th class="bg-red">出席</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="bg-logo" data-mh="assign-table">
                        <h3>
                          <strong>16：02</strong>
                        </h3>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-4">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th class="bg-green" colspan="2">帰り</th>
                    </tr>
                  </thead>
                  <tbody data-mh="assign-table">
                    <tr>
                      <th>バス乗車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>バス降車</th>
                      <td>00:00</td>
                    </tr>
                    <tr>
                      <th>入館</th>
                      <td>00:00</td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
      </section>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
