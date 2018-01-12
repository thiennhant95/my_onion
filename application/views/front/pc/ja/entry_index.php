<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_user_registration.php"); ?>

  <main id="page_init" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted">
        <div class="panel-heading">
          <div class="h4 block-30 text-break text-center">
            <strong>
              <span>無料体験・短期水泳教室・入会をご希望される方は、</span>
              <span>予めこちらからお申込みをいただきますと</span>
              <span>来館時のお手続きにかかる時間が短くなります。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご氏名</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="" placeholder="">
                <small>
                  <sup>※</sup>お子様が受講される場合は、お子様ご本人のお名前をご記入ください。</small>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">郵便番号</label>
              <div class="col-xs-3 col-sm-2 col-md-1 postal-code-line">
                <input type="number" class="form-control" value="" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 col-md-1">
                <input type="number" class="form-control" value="" placeholder="">
              </div>
              <div class="col-xs-3">
                <a href="#0" class="btn btn-main">&#12306; 住所に反映</a>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">ご住所</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">電話番号</label>
              <div class="col-sm-5">
                <input type="tel" class="form-control" value="" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">メールアドレス</label>
              <div class="col-sm-5">
                <input type="email" class="form-control" value="" placeholder="">
                <small>
                  <sup>※</sup>フィルタリング設定等で「xxx.xx.xx」からのメールを受信できるようになっているかご確認ください。
                </small>
              </div>
            </div>
          </form>

        </div>
        <div class="panel-footer text-center">
          <div class="block-30">
            <a href="#0" class="btn btn-success btn-lg btn-long">
              <i class="fa fa-angle-double-right" aria-hidden="true"></i>
              <span id="confirm">送信内容を確認</span>
            </a>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="#0">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>

  <main id="page_complete" class="content content-dark">
    <div class="container">

      <ol class="step-bar">
        <li class="visited">
          <span class="step-bar-number">1</span>
          <strong class="step-bar-text">ご連絡先情報のご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">2</span>
          <strong class="step-bar-text">お申込みアンケートのご記入</strong>
        </li>
        <li>
          <span class="step-bar-number">3</span>
          <strong class="step-bar-text">事前登録完了・クラブご来館</strong>
        </li>
      </ol>

      <div class="panel panel-doted text-center">
        <div class="panel-heading">
          <div class="block-30 text-break">
            <i class="fa fa-envelope-o form-send-confirm-icon" aria-hidden="true"></i>
            <strong>
              <span>ご記入いただきましたメールアドレス宛てに</span>
              <span>ご案内のメールを送信いたしました。</span>
            </strong>
          </div>
        </div>
        <div class="panel-body">
          <p class="form-send-confirm-display text-light">
            <strong>xxxxx@xxx.xx.xx</strong>
          </p>
          <div class="block-30 text-break">
            <strong>
              <span>引き続きメール内に記載のURLより、</span>
              <span>お申込みアンケートをご記入ください。</span>
            </strong>
          </div>
        </div>
      </div>

      <div class="block-15">
        <div class="row">
          <div class="col-sm-10 col-sm-offset-1 text-light">
            <p>
              <strong class="text-small">
                <sup>※</sup>もしメールが届いていない場合は、上記メールアドレスが正しいか、念のため迷惑メールフォルダの中に入っていないか、フィルタリング設定等で「xxx.xx.xx」からのメールを受信できるようになっているかご確認ください。
              </strong>
            </p>
            <p>
              <strong class="text-small">
                <sup>※</sup>メールソフトの設定や使い方等についてのご質問にはお答えいたしかねますので、ご利用されております携帯電話キャリアやインターネットプロバイダーへご確認ください
              </strong>
            </p>
          </div>
        </div>
      </div>

      <div class="block-30 text-center">
        <a class="btn btn-outline-main btn-long" href="#0">
          <i class="fa fa-home" aria-hidden="true"></i>
          <span>TOPへ戻る</span>
        </a>
      </div>

    </div>
  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>

<script>
    $(function() {
        $('#page_complete').css('display','none');

        $('main#page_init').on('click', 'span#confirm', function(event) {
            event.preventDefault();
            $('#page_init').css('display','none');
            $('#page_complete').css('display','block');
        });
    })
</script>
