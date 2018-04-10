//定数
get_define();

$(function () {
    var date = new Date();
    var initialLocaleCode = 'ja';
    var d = date.getDate();
    var m = date.getMonth() + 1;
    var y = date.getFullYear();
    var tmp_m = m - 1;
    var last_month = tmp_m <= 0 ? '去年' : tmp_m + '月';
    var next_month = (m == 12) ? '来年' : (m + 1);
    //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
    var start_date_selected = "";
    var arr_monday = [];
    var calendar = $('#calendar_recheduce').fullCalendar({

        //fullCalendarの設定
        locale: initialLocaleCode,
        displayEventTime: false,
        unselectAuto: false,
        //ボタンのカスタム
        customButtons: {
            pre_event: {
                text: '< ' + last_month,
                /**
                 * 翌月を押下時のイベント
                 */
                click: function () {
                    $('#calendar_recheduce').fullCalendar('prev');
                    get_prev_month();
                }
            },
            next_event: {
                text: next_month + '月' + ' >',
                /**
                 * 来月を押下時のイベント
                 */
                click: function () {
                    $('#calendar_recheduce').fullCalendar('next');
                    get_prev_month();
                }
            }
        },
        /*
         * 画面上部の表示設定
         */
        header: {
            left: 'pre_event',
            center: 'title',
            right: 'next_event'
                    // right: 'month,agendaWeek,agendaDay,listMonth'
        },
        // events: "events.php",
        eventRender: function (event, element, view) {
        },
        selectable: true,
        selectHelper: true,
        /**
         * カレンダーの日付枠　クリックイベント
         */
        select: function (start, end, allDay) {
            //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
            start_date_selected = fmt_date(start);
            //特定の条件の場合、start_date_selectedを空にする
            uncheck_multiple_date();
            //本日の日付（黄色表示） 2018-04-04
            var tmp_current_moment = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY-MM-DD');
            //未来または当日の日付枠がクリック
            if (start_date_selected >= tmp_current_moment) {
                //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
                let tmp_date = start_date_selected + ' 00:00';
                //月曜日以下がクリックされた場合
                if ($.inArray(tmp_date, arr_monday) == -1) {
                    //AJAXで日付のステータスを取得し、waringメッセージを表示または隠す
                    check_type_date();
                } else {
                    //月曜がクリックされた場合
                    srcoll_to_div('.header-mypage', '月曜日は休館日です。');
                }
                //お休み ⁄ 振替予定設定モーダル 内に要素を追加する
                //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
                set_info_to_modal_transfer(start_date_selected);
            } else {
                /**
                 * 過去の日付を選択した場合
                 */
                //unselect
                $('#calendar_recheduce').fullCalendar('unselect');
                let msg = '過去の日付を選択しないでください';
                //アラートを表示しメッセージをセット
                show_msg_alert(msg);
            }
        },
        eventDrop: function (event, delta) {
            // #code
        },
        /**
         *  カレンダーのイベントクリック時にコール
         *  
         *  イベント == 休館、休、振Cなどのアイコン
         */
        eventClick: function (event) {
            var id_date_current;
            //イベントのid
            id_date_current = event.id;
            //クリックされたイベントの日付 2018-04-19
            var date_click = fmt_date(event.start);
            //本日の日付（黄色表示） 2018-04-04
            var tmp_current_moment = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY-MM-DD');
            //未来または当時の日付がクリックされた
            if (tmp_current_moment <= date_click) {
                //クリックされたイベントのクラス名
                //console.log($(this).attr("class"));
                //C(通常出席予定日)アイコンクリック
                if ($(this).hasClass('presence_plan_date')) {
                    //モーダル modal_transferを表示
                    $('#modal_transfer').modal('show');
                    //モーダル modal_transferに情報をセット
                    set_info_to_modal_transfer(date_click);
                }
                //休アイコンクリック
                if ($(this).hasClass('rest_date')) {
                    //モーダル modal_rest_cancelを表示 (休みをキャンセルして通常通り出席する)
                    $('#modal_rest_cancel').modal('show');
                    set_info_to_modal_rest_cancel(id_date_current);
                }
                //振Cアイコンクリック
                if ($(this).hasClass('transfer_date')) {
                    //モーダル modal_transferを表示
                    $('#modal_transfer_cancel').modal('show');
                    set_info_to_modal_tranfer_cancel(id_date_current);
                }
            } else {
                //過去日付のアイコンがクリック
                //console.log('過去日付のアイコンがクリック');
                $('#calendar_recheduce').fullCalendar('unselect');
                let msg = '過去のデータです。編集出来ません。';
                show_msg_alert(msg);
            }
        },
        eventResize: function (event) {
        },
        /**
         * レンダリング時に呼ばれる
         */
        viewRender: function (event) {
            //現在選択中の月 MM
            month_current_select = $('#calendar_recheduce').fullCalendar('getDate').format('MM');
            //現在選択中の年 YYYY
            year_current_select = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY');
            //本日の日付（黄色表示） 2018-04-04
            var tmp_current_moment = $('#calendar_recheduce').fullCalendar('getDate').format('YYYY-MM-DD');
            /**
             * renderEvent関数 イベントを追加
             */
            var post_data = {
                post_year: year_current_select,
                post_month: month_current_select
            };
            //カレント月のテスト日をカレンダーにセット
            set_calendar_from_ajax("/reschedule/load_data_test", post_data, DATE_TEST, "test_class_btn");
            //カレント月の休館日をカレンダーにセット
            set_calendar_from_ajax("/reschedule/load_data_absent", post_data, DATE_CLOSED, "closed_class_btn");
            //カレント月の振替日をカレンダーにセット
            set_calendar_from_ajax("/reschedule/load_data_tranfer", post_data, REGISTED_TRANSFER, "transfer_date");
            //カレント月の休み日をカレンダーにセット
            set_calendar_from_ajax("/reschedule/load_data_rest", post_data, REGISTED_REST, "rest_date");
            //カレント月の無断欠席日をカレンダーにセット
            set_calendar_from_ajax("/reschedule/load_absent_w_permission", post_data, PERMISSION_DATE, "permission_date");
            //カレント月の通常出席予定日をカレンダーにセット 
            set_calendar_from_ajax("/reschedule/load_data_presence_plan", post_data, REGISTED_PRESENCE_PLAN, "presence_plan_date");

            //本日の日付（黄色表示） 2018-04-04 から オブジェクト作成
            var tmp_date_set = new Date(tmp_current_moment);
            var tmp_list_mondays = getMondays(tmp_date_set);
            arr_monday = [];

            for (let index = 0; index < tmp_list_mondays.length; index++) {
                var date = new Date(tmp_list_mondays[index]);
                var tmp_get_fmt_month = ('0' + (date.getMonth() + 1)).slice(-2);
                var tmp_get_fmt_date = ('0' + date.getDate()).slice(-2);
                var date_convert = date.getFullYear() + '-' + tmp_get_fmt_month + '-' + tmp_get_fmt_date + ' ' + '00:00';

                arr_monday.push(date_convert);
                /**
                 * renderEvent イベントを追加
                 */
                $('#calendar_recheduce').fullCalendar('renderEvent',
                        {
                            title: DATE_CLOSED,
                            start: date_convert,
                            className: "closed_class_btn monday_class",
                        }, false // make the event "stick"
                        );
            }
        }
    });

    /**
     * AJAX基本設定
     */
    function do_ajax(url, data) {
        return  $.ajax({
            type: "POST",
            url: url,
            data: data,
            dataType: 'JSON',
        });
    }

    /**
     * AJAXでデータを取得しカレンダーにセット
     * 
     */
    function set_calendar_from_ajax(url, data, kind, class_name) {
        //AJAX
        var res = do_ajax(url, data);
        //レスポンスをカレンダーにセット
        res.success(function (result) {
            if (result['list']) {
                //console.log(url);
                //console.log(result['list']);
                $.each(result['list'], function (key, element) {
                    var set_icon_date = element.target_date;
                    if (element.dist_date) {
                        set_icon_date = element.dist_date;
                    }
                    //renderEvent イベントを追加
                    render_event(calendar, element.id, kind, set_icon_date, set_icon_date, class_name);
                });
            }
            //失敗
        }).fail(function (result) {
        });
    }

    /**
     * 「C」アイコンがクリック時コール
     */
    function set_info_to_modal_transfer(date_selected_curr) {
        var url = "/reschedule/get_info_class_current";
        var post_data = {
            //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
            start_date_selected: start_date_selected
        }
        //AJAXでレスポンスを取得
        var res = do_ajax(url, post_data);
        res.success(function (result) {
            //[M]1100~1330
            let tmp_str_info = result.db_class_str;
            //<option value = "22"> [M] 1100~1330</option>
            //<option value = "24"> [E] 1805~1920</option>
            let tmp_select_calender = result.calendar_class;
            //お休み ⁄ 振替予定設定モーダル内、時間プルダウン作成
            fill_selected_time(tmp_select_calender);
            //お休み ⁄ 振替予定設定モーダル内、上部文字列作成
            //2018 年 4 月 19 日 [M]1100~1330 
            fill_date_click(date_selected_curr, tmp_str_info);
            //送迎バスプルダウンを作成
            //セレクトタグ内にoptionタグを書き込む
            $('#list_bus').html(result.db_bus);
            //理由プルダウンを作成
            //セレクトタグ内にoptionタグを書き込む
            $('#list_rest_reason').html(result.db_rest_reason);
            $('#list_examp').html(result.db_examp);
        }).fail(function (result) {
        });
    }

    /**
     * 「休」アイコンがクリック時コール
     */
    function set_info_to_modal_rest_cancel(id_cancel) {
        var url = "/reschedule/load_cancel_rest";
        var data = {
            id_send: id_cancel
        };
        //AJAX
        var res = do_ajax(url, data);
        //レスポンスをカレンダーにセット
        res.success(function (result) {
            if (result['data_cancel']) {
                let id_tran = result['data_cancel'][0]['id'];
                let date_tranfer = result['data_cancel'][0]['dist_date'];
                let content_title = result['data_cancel'][0]['contents'];
                let json_title = JSON.parse(content_title, true);
                //id 70
                $('.id_rest').val(id_tran);
                //タイトルをセット　2018 年 4 月 25 日 [M]1100~1330
                $('.cancel_rest_date').html(json_title.contents);
            }
            //失敗
        }).fail(function (result) {
        });
    }

    /**
     * 「振C」アイコンがクリック時コール
     */
    function set_info_to_modal_tranfer_cancel(id_cancel) {
        var url = "/reschedule/load_cancel_tranfer";
        var data = {
            id_send: id_cancel
        };
        //AJAX
        var res = do_ajax(url, data);
        //レスポンスをカレンダーにセット
        res.success(function (result) {
            if (result['data_cancel']) {
                let id_tran = result['data_cancel'][0]['id'];
                let date_tranfer = result['data_cancel'][0]['dist_date'];
                let content_title = result['data_cancel'][0]['contents'];
                let json_title = JSON.parse(content_title, true);
                $('.id_tranfer').val(id_tran);
                $('.cancel_tran_date').html(json_title.contents);
            }
            //失敗
        }).fail(function (result) {
        });
    }

    /**
     * 【select】でコール
     * 
     *  月曜日以外の日付枠がクリックされた場合にコール
     *  
     *  AJAXで日付のステータスを取得し、waringメッセージを表示または隠す
     */
    function check_type_date() {

        console.log('check_type_date()=======================================================');
        console.log(start_date_selected);

        $.ajax({
            type: "POST",
            url: "/reschedule/check_type_date",
            data: {
                //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
                start_date_selected: start_date_selected
            },
            dataType: 'JSON',
            success: function (result) {
                /**
                 * トップまでスクロールしwaringメッセージをセット
                 * または
                 * waringメッセージ隠す
                 */
                switch (result.type_date) {
                    case 1:
                        srcoll_to_div('.header-mypage', ' CLOSED DATE, can not register');
                        break;
                    case 2:
                        srcoll_to_div('.header-mypage', ' TEST DATE, can not register');
                        break;
                    case 3:
                        srcoll_to_div('.header-mypage', ' NOTRANSFER DATE, can not register');
                        break;
                    case 4:
                        srcoll_to_div('.header-mypage', ' CONSTRUCTION DATE, can not register');
                        break;
                    default:
                        hiden_waring();
                        //#show_modal_regをクリックしたことにして、イベントを発火
                        $("#show_modal_reg").trigger("click");
                        break;
                }
            }
        });
    }


    /**
     * クリックイベント
     * 
     * お休み ⁄ 振替予定設定モーダル
     * 
     * 「お休みにしました」 ボタン押下時
     */
    $('#send_register_rest').on('click', function (params) {
        console.log('「お休みにしました」 ボタン押下時');
        //POSTデータ取得
        //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
        let post_data = get_post_data('rest', start_date_selected);
        $.ajax({
            type: "POST",
            url: "/reschedule/register_rest_date",
            data: post_data,
            dataType: 'JSON',
            success: function (result) {
                if (result.status) {
                    //console.log(result);
                    if (result.type == ABSENCE) {
                        //renderEvent イベントを追加
                        //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
                        render_event(calendar, result.id_reg, REGISTED_REST, start_date_selected, start_date_selected, "rest_date");
                    }
                }
            }
        })
    });

    /**
     * お休み  振替予定設定
     * 「振替日を設定しました」　ボタン押下イベント
     */
    $('#send_transfer').on('click', function (params) {
        //POSTデータ取得
        //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
        let post_data = get_post_data('transfer', start_date_selected);
        $.ajax({
            type: "POST",
            url: "/reschedule/register_rest_date",
            data: post_data,
            dataType: 'JSON',
            success: function (result) {
                if (result.status) {
                    //renderEvent イベントを追加
                    //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
                    render_event(calendar, result.id_reg, REGISTED_TRANSFER, start_date_selected, start_date_selected, "transfer_date");
                }
            }
        })
    });

    /**
     * クリックイベント
     * 
     * 「振替をキャンセルする」ボタン押下時
     */
    $('.delete_tranfer').on('click', function () {
        let id_tranfer = $('.id_tranfer').val();
        remove_date_tranfer(id_tranfer);
    })

    /**
     * クリックイベント
     * 
     * 「休みをキャンセルして通常通り出席する」ボタン押下時
     */
    $('.delete_rest').on('click', function () {
        let id_rest = $('.id_rest').val();
        remove_date_rest(id_rest);
    })

    /**
     * bootstrap modal がshowで発火
     * 
     *お休み ⁄ 振替予定設定 (#modal_transfer)モーダルがshowされたときコール
     */
    $('#modal_transfer').on('show.bs.modal', function (e) {
        $('body').css('padding-right', '0px');
    });

    /**
     * bootstrap modal がshowで発火
     * 
     *お休み ⁄ 振替予定設定 (#modal_transfer)モーダルがshowされたときコール
     */
    $('#modalSelectOption').on('show.bs.modal', function (e) {
        $('body').css('padding-right', '0px');
    });


    /**
     * クリックイベント
     * 
     * お休み ⁄ 振替予定設定モーダル
     * 
     * 時間プルダウン変更時に、送迎バスの選択肢を変更する
     */
    $('#fill_select_time').on('change', function name() {
        let tmp_id = $('#fill_select_time').val();
        $.ajax({
            type: "POST",
            url: "/reschedule/get_busroute_of_class",
            data: {
                id_class_selected: tmp_id
            },
            dataType: 'JSON',
            success: function (result) {
                $('#list_bus').html(result.html);
            }
        });
    });


});

/*
 * renderEvent イベントを追加
 */
function render_event(calendar, id, title, start, end, className) {
    var ary = {
        id: id,
        title: title,
        start: start,
        end: end,
        className: className
    };
    //イベントを追加
    calendar.fullCalendar('renderEvent', ary, false);
}

/*
 * POSTデータ取得
 * start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
 */
function get_post_data(tmp_type, start_date_selected) {
    return {
        tmp_time_reason: $('#fill_select_time').find(":selected").text(),
        tmp_list_examp: $('#list_examp').find(":selected").text(),
        tmp_list_bus: $('#list_bus').find(":selected").text(),
        tmp_list_rest_reason: $('#list_rest_reason').find(":selected").text(),
        text_reason: $('#text_reason').val(),
        tmp_courname: $('#course_current').val(),
        tmp_class_id: $('#class_id_current').val(),
        tmp_class_name: $('#class_name_current').val(),
        //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
        tmp_dist_date: start_date_selected,
        tmp_type: tmp_type,
        tmp_title: $('.date-select-tmp').text()
    }
}

/**
 * 「振替をキャンセルする」ボタン押下時
 */
function remove_date_tranfer(id_selected) {
    $('#calendar_recheduce').fullCalendar('removeEvents', id_selected);
    $.ajax({
        type: "POST",
        url: "/reschedule/remove_date_rest_tranfer",
        dataType: 'json',
        data: {
            delete_tranfer: 1,
            id_of_date_del: id_selected
        },
        success: function (rel) {
        }
    })
}

/**
 * 「休みをキャンセルして通常通り出席する」ボタン押下時
 */
function remove_date_rest(id_selected) {
    $('#calendar_recheduce').fullCalendar('removeEvents', id_selected);
    $.ajax({
        type: "POST",
        url: "/reschedule/remove_date_rest_tranfer",
        dataType: 'json',
        data: {
            delete_rest: 1,
            id_of_date_del: id_selected
        },
        success: function (rel) {
        }
    })
}

/**
 * 2018-04-19　→　2018 年 4 月 19 日　コンバート
 */
function conver_date_jp(date_input) {
    let tmp_date = new Date(date_input);
    let tmp_day = tmp_date.getDate();
    let tmp_month = tmp_date.getMonth();
    let tmp_year = tmp_date.getFullYear();
    let date_jp = [tmp_year, '年', tmp_month + 1, '月', tmp_day, '日'].join(' ');
    return date_jp;
}

/**
 * 翌月、前月ボタン押下時
 */
function get_prev_month() {
    //console.log('get_prev_month()============================================================');
    //押下先の月　（6,7）月など
    var current_month_tmp = $('#calendar_recheduce').fullCalendar('getDate').format('M');
    //押下前の月　（6,7）月など
    var last_month_tmp = current_month_tmp - 1;
    //表示月の翌月
    var next_month_tmp = (+current_month_tmp == 12) ? '' : (+current_month_tmp + 1);
    //1月の場合 < 去年  それ以外は < 月
    (last_month_tmp == 0) ? $('.fc-pre_event-button').html('< 去年') : $('.fc-pre_event-button').html('< ' + last_month_tmp + '月');
    //12月の場合  来年 > それ以外は  月 >
    (next_month_tmp == '') ? $('.fc-next_event-button').html('来年 >') : $('.fc-next_event-button').html(next_month_tmp + '月' + ' >');
}

/**
 * ・お休み ⁄ 振替予定設定モーダル内、id="fill_select_time"に引数を書き込む
 * ・引数：
 *     <option value = "22"> [M] 1100~1330</option>
 *     <option value = "24"> [E] 1805~1920</option>
 */
function fill_selected_time(db_calendar) {
    //console.log('fill_selected_time()==================================');
    //console.log(db_calendar);
    $('#fill_select_time').html(db_calendar);
}

/*
 * お休み ⁄ 振替予定設定モーダルの上部の文字列を書き込む
 * 2018 年 4 月 19 日 [M]1100~1330 (サンプル)
 */
function fill_date_click(date_selected, str_info_class) {
    //console.log('fill_date_click()=========================================');
    //console.log(date_selected);
    //console.log(str_info_class);
    //2018 年 4 月 19 日 2018-04-19
    let date_jp = conver_date_jp(date_selected);
    $('.date-select-tmp').html(date_jp + ' ' + str_info_class);
}

/**
 * アラートを表示しメッセージをセット
 */
function show_msg_alert(msg) {
    $("#btn_modal_show_alert").trigger("click");
    $('#modalShowAlert .content_alert').html(msg);
}

/**
 * ・オプション：select内でコール
 * 
 * 特定の条件の場合、start_date_selectedを空にする
 * 
 * fc-weekクラス（週のクラス）内 divが
 * fc-highlight-skeletonクラスを持っていた場合、
 * highlightのカウントを取得
 * グローバル：start_date_selectedを空にする
 * 
 * //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
 * 
 */
function uncheck_multiple_date() {
    if ($('.fc-week div').hasClass('fc-highlight-skeleton')) {
        var count = '';
        count = $('.fc-highlight').attr("colSpan");
        //console.log('highlight-count-------------------------');
        //console.log(count);
        if (count > 1) {
            calendar.fullCalendar('unselect');
            //start_date_selected == 日付枠クリックで取得された日付 2018-04-28形式
            start_date_selected = '';
            return false;
        }
    }
}

function getMondays(date) {
    var d = new Date(date),
            month = d.getMonth(),
            mondays = [];
    d.setDate(1);
    // // Get the first Monday in the month
    while (d.getDay() !== 1) {
        d.setDate(d.getDate() + 1);
    }
    // Get all the other Mondays in the month
    while (d.getMonth() === month) {
        mondays.push(new Date(d.getTime()));
        d.setDate(d.getDate() + 7);
    }
    return mondays;
}

/**
 * YYYY-MM-DD HH:mmフォーマットへコンバート
 */
function fmt(date) {
    return date.format("YYYY-MM-DD HH:mm");
}

/**
 * YYYY-MM-DDフォーマットへコンバート
 */
function fmt_date(date) {
    return date.format("YYYY-MM-DD");
}

/**
 * Mフォーマットへコンバート
 */
function format_month(date) {
    return date.format('M');
}

/**
 * YYYYフォーマットへコンバート
 */
function format_year(date) {
    return date.format('YYYY');
}

/**
 * トップまでスクロールしwaringメッセージをセット
 */
function srcoll_to_div(id_div, msg) {
    $('html,body').animate({
        scrollTop: $(id_div).offset().top},
            'slow');
    $('#waring-msg').css('display', 'block');
    $('.alert-danger span').find('span').text(msg);
}

/**
 * waringメッセージ隠す
 */
function hiden_waring() {
    $('#waring-msg').css('display', 'none');
}
