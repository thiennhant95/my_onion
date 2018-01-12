<?php 

class simple_db {

    // INSERT時に発行されたid
    public $last_id = NULL;

    // SELECTするテーブルの件数
    public $found_rows = NULL;

    protected $pdo = NULL;

    function __construct($initialize = array()) {
        try {
            $host = isset($initialize['host']) ? $initialize['host'] : '';
            $dbname = isset($initialize['dbname']) ? $initialize['dbname'] : '';
            $user = isset($initialize['user']) ? $initialize['user'] : '';
            $pwd  = isset($initialize['password']) ? $initialize['password'] : '';

            $dsn  = "mysql:dbname={$dbname};host={$host};charset=utf8";
            $this->pdo = new PDO($dsn, $user, $pwd);
            $this->pdo->query('SET NAMES utf8');

        } catch (Exception $e) {
            return $e->getMessage();
        }
    }


    /**
     * データベースからSELECTする
     * 
     * @param   string  クエリー
     * @param   array   WHEREのパラメータ ※キーはプレースホルダで指定
     * @return  array   
     */
    public function select($sql = NULL, $parameters = array()) {
        $stmt = $this->pdo->prepare(preg_replace(array("/SELECT /", "/select /"), "SELECT SQL_CALC_FOUND_ROWS ", $sql, 1));
        if (!$stmt) {
            echo "\nPDO::errorInfo():\n";
            print_r($this->pdo->errorInfo());
        }
        $ret = $stmt->execute($parameters);
        if ($ret) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql = 'SELECT FOUND_ROWS() AS count';
            $stmt = $this->pdo->query($sql);
            $result2 = $stmt->fetch();
            $this->found_rows = $result2['count'];

            return $result;
        } else {
            echo "err";
            print_r($stmt->errorInfo());
        }
    }

    /**
     * データベースにINSERTする
     * 
     * @param   string  テーブル名
     * @param   array   INSERTする内容 ※キーは ":".カラム名 の形式
     * @return  
     */
    public function insert($tblname = NULL, $parameters = array()) {
        $fmt = "INSERT INTO %s (%s) VALUES(%s);";
        $sql = sprintf(
                $fmt, 
                $tblname, 
                implode(",", array_map(create_function('$e', 'return "`".trim($e, ":")."`";'), array_keys($parameters))),
                implode(",", array_keys($parameters))
        );
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($parameters);

        $sql = 'SELECT last_insert_id() AS id ';
        $stmt = $this->pdo->query($sql);
        $result = $stmt->fetch();
        $this->last_id = $result['id'];
    }

    /**
     * データベースをUPDATEする
     * 
     * @param   string  テーブル名
     * @param   array   UPDATEする時の条件 ※キーは ":".カラム名 の形式
     * @param   array   UPDATEする内容     ※キーは ":".カラム名 の形式
     * @return  
     */
    public function update($tblname = NULL, $key = array(), $parameters = array()) {
        $fmt = "UPDATE %s SET %s WHERE %s;";
        $sql = sprintf(
                $fmt, 
                $tblname, 
                implode(",", array_map(create_function('$e', 'return "`".trim($e, ":")."`" . "=" . $e;'), array_keys($parameters))),
                implode(",", array_map(create_function('$e', 'return "`".trim($e, ":")."`" . "=" . $e;'), array_keys($key)))
        );
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_merge($key, $parameters));

    }

    /**
     * クエリー実行
     * 
     * @param   string  クエリー
     * @param   array   パラメータ     ※キーはプレースホルダで指定
     * @return  
     */
    public function query($query = '', $parameters = array()) {
        $stmt = $this->pdo->prepare($query);
        return $stmt->execute($parameters);
    }
}

