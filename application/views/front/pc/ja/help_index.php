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
      <a href="/help/export_to_pdf_2" target="_blank">click me to download the file</a>
      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">新規入会時ご案内の再確認</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link"  id="export_to_pdf">ご案内を見る</a>
              </li>
            </ul>
          </div>
        </div>
      </section>

      <section>
        <div class="panel panel-doted">
          <div class="panel-heading text-center">よくある質問</div>
          <div class="panel-body">
            <ul class="link-list">
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT0">よくある質問</a>
                <div id="QT0" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                  </span>
                </div>

              </li>
              <li>
                <a class="btn btn-link" data-toggle="collapse" data-target="#QT1">よくある質問</a>
                <div id="QT1" class="collapse">
                  <span>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                    sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                    quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
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
            </ul>
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

    $('#export_to_pdf').click(function(){
      $.ajax({
        url:'/help/export_to_pdf',
        type:'POST',
        // dataType: 'html',
        success:function(res){
          console.log("So easy !");
        },
        error : function(XMLHttpRequest, textStatus, errorThrown) {
            console.log("cann't export to pdf file !");
        }
        
      });
    });
  });
</script>
