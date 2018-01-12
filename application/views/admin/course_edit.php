<!DOCTYPE html>
<html lang="ja">

<head>
  <?php require_once("head.php"); ?>
</head>

<body>
  <?php require_once("contents_header_admin.php"); ?>

  <main class="content content-dark">
    <div class="container">

      <h1 class="lead-heading h3">
        <span>練習コース編集</span>
      </h1>

      <div class="panel panel-default">
        <div class="panel-body">

          <form class="form-horizontal">
            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コースコード</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="1240" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">練習コース名</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">会費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
                <input type="text" class="form-control" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span>7020円</span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">休会費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
                <input type="text" class="form-control" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span>3240円</span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">バス管理費</label>
              <div class="col-xs-4 col-sm-2 sub-label">
                <span>品目コード</span>
              </div>
              <div class="col-xs-4">
                <input type="text" class="form-control" placeholder="">
              </div>
              <div class="col-xs-3 col-sm-2 sub-label">
                <span>864円</span>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">記号</label>
              <div class="col-sm-5">
                <input type="text" class="form-control" value="Y" placeholder="">
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">回数</label>
              <div class="col-sm-10">
                <div class="form-inline">
                  <label class="radio-inline">
                    <input type="radio" name="number" value=""> 週
                  </label>
                  <label class="radio-inline">
                    <input type="radio" name="number" value=""> 月
                  </label>
                  <select class="form-control mr-1 ml-1">
                    <option value="">1</option>
                    <option value="">2</option>
                    <option value="">3</option>
                    <option value="">4</option>
                    <option value="">5</option>
                    <option value="">6</option>
                    <option value="">7</option>
                    <option value="">8</option>
                  </select>
                  <label class="radio-inline">
                    <input type="radio" name="number" value=""> フリー
                  </label>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">振替機能</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="transfer" value=""> あり
                </label>
                <label class="radio-inline">
                  <input type="radio" name="transfer" value=""> なし
                </label>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">コース種別</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="course-type" value=""> 通常
                </label>
                <label class="radio-inline">
                  <input type="radio" name="course-type" value=""> 短期
                </label>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">開催開始</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">開催終了</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">申込開始</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">申込終了</label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">2000年</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1月</option>
                </select>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">1日</option>
                </select>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                <small>（年齢）</small>
              </label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
              <div class="col-xs-1 sub-label">
                <p class="text-center">〜</p>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-xs-12 col-sm-2 control-label">参加条件
                <small>（級）</small>
              </label>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
              <div class="col-xs-1 sub-label">
                <p class="text-center">〜</p>
              </div>
              <div class="col-xs-3">
                <select class="form-control">
                  <option value="">---</option>
                </select>
              </div>
            </div>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">参加条件
                <small>（級）</small>
              </label>
              <div class="col-sm-10">
                <div class="block-15">
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができない
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 水に顔をつけることができる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 潜れる
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 浮かべる
                    </label>
                  </div>
                  <div class="row block-15">
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタ足</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">板キック</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">背泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">クロール</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">平泳ぎ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                    <div class="col-xs-6 col-sm-4">
                      <label for="" class=" control-label">バタフライ</label>
                      <select class="form-control">
                        <option value="">25m</option>
                      </select>
                    </div>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 無料体験に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 短期水泳教室に参加をしたことがある
                    </label>
                  </div>
                  <div class="checkbox">
                    <label>
                      <input type="checkbox" value=""> 当クラブまたは他クラブに通っていたことがある
                    </label>
                  </div>
                </div>
              </div>
            </div>

            <hr>

            <div class="form-group">
              <label for="" class="col-sm-2 control-label">有効/無効</label>
              <div class="col-sm-10">
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 有効
                </label>
                <label class="radio-inline">
                  <input type="radio" name="enable" value=""> 無効
                </label>
              </div>
            </div>
          </form>

        </div>
      </div>
      <div class="block-15 text-center row">
        <div class="col-sm-4 col-sm-offset-2">
          <p>
            <a class="btn btn-default btn-block" href="#0">
              <span>戻る</span>
            </a>
          </p>
        </div>
        <div class="col-sm-4">
          <p>
            <a class="btn btn-success btn-block" href="#0">
              <span>更新</span>
            </a>
          </p>
        </div>
      </div>
    </div>

  </main>

  <?php require_once("contents_footer.php"); ?>
</body>

</html>
