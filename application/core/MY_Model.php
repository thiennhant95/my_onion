<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

// データベース用モデル
class DB_Model extends CI_Model {

    // モデル名から取得したテーブル名
    protected $tbl;

    // 取得件数
    protected $found_rows = 0;

    // auto increment id
    protected $last_id = 0;
    
    // 使用しているユーザーの情報
    // public $accountVar = array();
    
    // 設定情報
    public $configVar = array();

    // SHOP用DB
    public $shop_db = NULL;

     public function __construct() {
        parent::__construct();

        // Model名からテーブル名取得
        $this->tbl = substr(strtolower(get_class($this)), 0, -6);

        // 設定値読み込み
        $this->_set_config();
    }

    /**
     * テーブルの全件数を返却する
     * @param 
     * @return integer  件数
     */
    public function get_found_rows() {
        return $this->found_rows;
    }

    /**
     * autoincrement IDを返却する
     * @param 
     * @return integer  件数
     */
    public function get_last_insert_id() {
        return $this->last_id;
    }

    /**
     * テーブルデータ件数
     * @param   
     * @param   
     * @return  
     */
    public function select_count() {
        $res = $this->db->query("SELECT COUNT(id) AS count FROM " . $this->tbl);
        if ($res === FALSE) {
            logerr($params, $query);
            throw new Exception();
        }

        $result = $res->row_array();
        return $result['count'];
    }

    /**
     * テーブルデータ削除
     * @param   
     * @param   
     * @return  
     */
    public function truncate() {
        $this->db->query("TRUNCATE TABLE " . $this->tbl);
    }

    /**
     * 全件取得する ※レコードが時間経過によって増加するテーブルの場合は使用不可
     * @param string    テーブル名
     * @return boolean 実行結果
     */
    public function select_all($tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        $params = array(
            DATA_NOT_DELETED, // 削除フラグ
        );

        $sql =  "SELECT * FROM `" . $tbl ."` ";
        $sql .= "WHERE delete_flg = ? ";
        $sql .= "ORDER BY orderby ASC, id ASC";

        $res = $this->db->query($sql, $params);
        if ($res === FALSE) {
            logerr($params, $sql);
            throw new Exception();
        }

        return $res->result_array();
    }

    /**
     * IDを指定して1件取得する
     * @param integer   id
     * @param string    キー
     * @param string    テーブル名
     * @return array    取得結果
     */
    public function select_by_id($id, $key = 'id', $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        $params = array(
            $id,        // ID
            DATA_NOT_DELETED, // 削除フラグ
        );

        $sql =  "SELECT * FROM `". $tbl . "` ";
        $sql .= "WHERE " . $key . " = ? AND delete_flg = ? ";

        $res = $this->db->query($sql, $params);
        if ($res === FALSE) {
            logerr($params, $sql);
            throw new Exception();
        }
        $result = $res->result_array();

        $this->found_rows = count($result);
        return $result;
    }

    /**
     * idをアップデートする
     * @param array POSTデータ
     * @param string テーブル名
     * @return boolean 実行結果
     */
    public function update_by_id($params, $key = 'id', $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        // create_date, create_id は念のため削除する
        if (isset($params['create_date'])) unset($params['create_date']);
        if (isset($params['create_id'])) unset($params['create_id']);

        $params['update_date'] = NULL;
        $params['update_id']   = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;

        // クエリー作成
        $query = $this->db->update_string($tbl, $params, $key . ' = "'.$params[ $key ] . '"');

        if (FALSE === $this->db->query($query)) {
            logerr($query);
            throw new Exception();
        }
    }

    /**
     * 新規追加
     * @param array POSTデータ
     * @param string テーブル名
     * @return boolean 実行結果
     */
    public function insert($params = array(), $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        // id は念のため削除しておく
        if (isset($params['id'])) unset($params['id']);
        
        // 新規追加時は、create_dateはNULLにする
        $params['update_date'] = $params['create_date'] = NULL;
        $params['update_id']   = $params['create_id']   = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;

        // クエリー作成
        $query = $this->db->insert_string($tbl, $params);

        if (FALSE === $this->db->query($query)) {
            logerr($query);
            throw new Exception();
        }

        $query = 'SELECT last_insert_id() as id ';
        $res = $this->db->query($query);
        if (FALSE === $res) {
            logerr($query);
            throw new Exception();
        }
        $result = $res->row_array();

        $this->last_id = $result['id'];
    }

    /**
     * 配列で新規追加
     * @param array 追加するデータ
     * @param string テーブル名
     * @return boolean 実行結果
     */
    public function insert_array($params = array(), $tbl = NULL) {
        if (empty($params) || !is_array($params)) return;

        $tbl = empty($tbl) ? $this->tbl : $tbl;

        $values = array();
        foreach ($params as $row) {
            $tmp = $row;
            $tmp['update_date'] = get_datetime();
            $tmp['create_date'] = get_datetime();
            $values[] = '("' . implode('","', $tmp) . '")';
        }

        $query = 'INSERT INTO ' . $tbl . ' (' . implode(', ', array_keys($tmp)) .') VALUES' . implode(',', $values);

        if (FALSE === $this->db->query($query)) {
            logerr($query);
            throw new Exception();
        }
        $this->last_id = NULL;
    }

    /**
     * 新規追加(orderbyを考慮)
     * @param array POSTデータ
     * @param string テーブル名
     * @return boolean 実行結果
     */
    public function insert_orderby($params = array(), $cond = NULL, $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        // orderby, id は念のため削除
        if (isset($params['orderby'])) unset($params['orderby']);
        if (isset($params['id'])) unset($params['id']);

        // 新規追加時は、create_dateはNULLにする
        $params['update_date'] = $params['create_date'] = NULL;
        $params['update_id']   = $params['create_id']   = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;

        $keys = array_keys($params);
        $values = array_values($params);
        $binds = str_repeat("?, ", count($keys));

        $query = sprintf("INSERT INTO %s (%s, orderby) SELECT %s %s FROM %s WHERE %s = %s AND delete_flg = %s",
                    $tbl,
                    implode(', ', $keys),
                    $binds,
                    'COALESCE(MAX(orderby)+1, 1)',
                    $tbl,
                    ($cond == NULL ? '1' : $cond), 
                    ($cond == NULL ? '1' : $params[ $cond ]),
                    DATA_NOT_DELETED
               );

        if (FALSE === $this->db->query($query, $values)) {
            logerr($values, $query);
            throw new Exception();
        }

        $query = 'SELECT last_insert_id() AS id ';
        $res = $this->db->query($query);
        if (FALSE === $res) {
            logerr($query);
            throw new Exception();
        }
        $result = $res->row_array();
        $this->last_id = $result['id'];
    }

    /**
     * 1件削除（削除フラグを立てる）
     * @param interger 削除するid
     * @param string 削除するidに対するカラム名
     * @param string テーブル名
     * @return boolean 実行結果
     */
    public function delete($id, $key = NULL, $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;
        $key = empty($key) ? 'id' : $key;

        // 削除パラメータ設定
        $params['update_date'] = $params['delete_date'] = date("Y-m-d H:i:s");
        $params['update_id']   = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;
        $params['delete_flg'] = DATA_DELETED;

        // クエリー作成
        $query = $this->db->update_string($tbl, $params, $key . ' = ' . $id);

        if (FALSE === $this->db->query($query)) {
            logerr($params, $query);
            throw new Exception();
        }
    }

    /**
     * 配列を復号化する（コールバック関数）
     * @param   array 復号化する配列
     * @return  array 復号化後の配列
     */
    public function rot13decrypt($params) {
        logdebug($params);
        $tmp = $params;
        if (isset($tmp['email'])) {
            $tmp['email'] = rot13decrypt($tmp['email']);
        }
        if (isset($tmp['passwd'])) {
            $tmp['passwd'] = rot13decrypt($tmp['passwd']);
        }
        return $tmp;
    }

    /**
     * IDがあれば更新、なければ登録
     * @param array POSTデータ
     * @return boolean 実行結果
     */
    public function duplicate_insert($params, $key = 'id', $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        // create_date, create_id は念のため削除する
        if (isset($params['create_date'])) unset($params['create_date']);
        if (isset($params['create_id'])) unset($params['create_id']);
        
        $params['update_date'] = NULL;
        $params['update_id']   = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;

        foreach($params as $key => $val) {
            $fields[] = $this->db->_escape_identifiers($key);
            $values[] = $this->db->escape($val);
        }
        
        $create_id = isset($this->accountVar['id']) ? $this->accountVar['id'] : 0;

        // クエリー作成
        $query  = 'INSERT INTO '. $tbl .' ('. implode(',', $fields) .',create_id,create_date) VALUES ';
        $query .= '('. implode(',', $values) .','. $create_id .',NULL) ';
        $query .= 'ON DUPLICATE KEY UPDATE ';
        foreach($fields as $field) {
            $query .= $field . ' = VALUES('.$field.') ';
            if($field !== end($fields)){
                $query .= ', ';
            }
        }

        if (FALSE === $this->db->query($query)) {
            logerr($query);
            throw new Exception();
        }

        $query = 'SELECT last_insert_id() AS id ';
        $res = $this->db->query($query);
        if (FALSE === $res) {
            logerr($query);
            throw new Exception();
        }
        $result = $res->row_array();
        $this->last_id = $result['id'];
    }

    /**
     * idの表示順を下げる
     * @param integer
     * @param string
     * @param integer
     * @return
     */
    public function orderdown($id, $key, $value) {
        // idのページ情報を取得
        $res = $this->select_by_id($id);

        // 教材が同じで表示順が1つ前のページ情報を取得する
        if (isset($res['orderby']) && $res['orderby'] > 0) {
            $query  = 'SELECT * FROM '. $this->tbl . ' ';
            $query .= 'WHERE ' . $key . ' = ? AND delete_flg = ? AND orderby > ? ';
            $query .= 'ORDER BY orderby ASC, id ASC ';

            $params = array(
                $value,
                DATA_NOT_DELETED,
                $res['orderby'],
            );
            $other = $this->db->query($query, $params);

            // 表示順入れ替え
            $this->swap_orderby($res, $other->row_array());
        } else {
            throw new Exception(ERROR_DATABASE . my_trace());
        }
    }

    /**
     * idの表示順を上げる
     * @param integer
     * @return array    取得結果
     */
    public function orderup($id, $key, $value) {
        // idのページ情報を取得
        $res = $this->select_by_id($id);

        // 教材が同じで表示順が1つ前のページ情報を取得する
        if (isset($res['orderby']) && $res['orderby'] > 0) {
            $query  = 'SELECT * FROM '. $this->tbl . ' ';
            $query .= 'WHERE ' . $key . ' = ? AND delete_flg = ? AND orderby < ? ';
            $query .= 'ORDER BY orderby DESC, id ASC';

            $params = array(
                $value,
                DATA_NOT_DELETED,
                $res['orderby'],
            );
            $other = $this->db->query($query, $params);

            // 表示順入れ替え
            $this->swap_orderby($res, $other->row_array());
        } else {
            throw new Exception(ERROR_DATABASE . my_trace());
        }
    }

    /**
     * ２つのページの表示順を入れ変える
     * @param array
     * @param array
     * @return 
     */
    protected function swap_orderby($page, $other) {

        if (empty($page) || empty($other)) {
            logdebug('empty');
            return FALSE;
        }

        // 表示順を入れ替える
        $update_page = array(
            'orderby' => $other['orderby']
        );
        $query_update_page = $this->db->update_string($this->tbl, $update_page, 'id = '.$page['id']);

        $update_other = array(
            'orderby' => $page['orderby']
        );
        $query_update_other = $this->db->update_string($this->tbl, $update_other, 'id = '.$other['id']);

        // クエリ発行
        $this->db->trans_start();
        $this->db->query($query_update_page);
        $this->db->query($query_update_other);
        $this->db->trans_complete();

        if (FALSE === $this->db->trans_status()) {
            throw new Exception(ERROR_DATABASE . my_trace());
        } else {
            return TRUE;
        }
    }

    /**
     * 一覧を取得し、IDをキーにして返却
     * @param 
     * @return array    取得結果
     */
    public function get_list($where = array(), $order = NULL, $tbl = NULL) {
        $tbl = empty($tbl) ? $this->tbl : $tbl;

        $query  = "SELECT * FROM `" . $tbl . "` ";
        $query .= "WHERE delete_flg = 0 ";
        if (!empty($where)) {
            foreach ($where as $key => $value) {
                $query .= "AND `" . $key ."` " . $value ." ";
            }
        }
        if (!empty($order)) {
            $query .= "ORDER BY " . $order . " ";
        }

        $res = $this->db->query($query);
        if ($res === FALSE) {
            logerr($params, $sql);
            throw new Exception();
        }

        $result = $res->result_array();
        return array_combine(array_column($result, 'id'), $result);
    }

    protected function _set_config() {
        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = array_merge($_config, $_config2);
    }
}


class MY_Model extends CI_Model {

    // 設定情報
    public $configVar = array();

    // 使用しているユーザーの情報
    public $accountVar = array();

    public function __construct() {
        parent::__construct();

        // 設定値読み込み
        $this->_set_config();
    }

    protected function _set_config() {
        // 設定値読み込み
        $this->config->load('config', TRUE);
        $_config = $this->config->item('config');
        $this->config->load('my_config', TRUE);
        $_config2 = $this->config->item('my_config');
        $this->configVar = array_merge($_config, $_config2);
    }
}

