<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_mypage.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading lead-heading-icon-help bg-violet h3">ヘルプ</h1>
      <form action="/help/export_to_pdf" method="POST" name="export_FAQ" target="_blank" >
      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">新規入会時ご案内の再確認</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link" id="export_to_pdf" >ご案内を見る</a>
              </li>
            </ul>
          </div>
        </div>
      </section>
      <input type="text" name="html" hidden>
      </form>
      <section class="data-question">
        <div class="panel panel-doted">
          <div class="panel-heading" style="margin-left: 40%">よくある質問</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT0">よくある質問</a>
                <div id="QT0" class="collapse">
                  <span>
                   ピンポン ピンポンピンポンピンポン ピンポン ピンポン ピンポン ピンポン ピンポン ピンポン ピンポン ピンポン
                  </span>
                </div>

              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT1">よくある質問</a>
                <div id="QT1" class="collapse">
                  <span>
                    回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT2">よくある質問</a>
                <div id="QT2" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT3">よくある質問</a>
                <div id="QT3" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT4">よくある質問</a>
                <div id="QT4" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT5">よくある質問</a>
                <div id="QT5" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>
              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT6">よくある質問</a>
                <div id="QT6" class="collapse">
                  <span>
                   回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li><li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT7">よくある質問</a>
                <div id="QT7" class="collapse">
                  <span>
                   回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li><li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT8">よくある質問</a>
                <div id="QT8" class="collapse">
                  <span>
                    回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li><li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT9">よくある質問</a>
                <div id="QT9" class="collapse">
                  <span>
                    回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li><li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT10">よくある質問</a>
                <div id="QT10" class="collapse">
                  <span>
                    回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li><li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT11">よくある質問</a>
                <div id="QT11" class="collapse">
                  <span>
                    回答回答回答回答回答回答回答回答回答回答回答回答 回答回答回答回答回答回答回答回答回答回答回答回答
                  </span>
                </div>

              </li>
          </div>
        </div>
      </section>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
<script type="text/javascript">
  $(document).ready(function(){
      var html = $('section.data-question').html();
      var input = $('input[name = html]').val(html);
    $('#export_to_pdf').click(function(){
      $('form[name = export_FAQ]').submit();
      });
  });
</script>
