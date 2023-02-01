<?php
class DB
{
    private static $dbh = null;
    private static $res, $data, $count, $sql;

    public function __construct()
    {
        self::$dbh = new PDO("mysql:host=localhost;dbname=php_project", 'root', '');
        self::$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function query($parm = [])
    {
        self::$res =  self::$dbh->prepare(self::$sql);
        self::$res->execute($parm);
        return $this;
    }

    public function getAll()
    {
        $this->query();
        self::$data = self::$res->fetchAll(PDO::FETCH_OBJ);
        return self::$data;
    }

    public function getOne()
    {
        $this->query();
        self::$data = self::$res->fetch(PDO::FETCH_OBJ);
        return self::$data;
    }

    public function count()
    {
        $this->query();
        self::$count = self::$res->rowCount();
        return self::$count;
    }

    public static function table($table)
    {
        $sql = "select * from $table";
        self::$sql = $sql;
        $db = new DB();
        return $db;
    }

    public function orderBy($col, $value)
    {
        self::$sql .= " order by $col $value";
        return $this;
    }

    public function where($col, $value, $operator = '=')
    {
        self::$sql .= " where $col $operator '$value'";
        return $this;
    }

    public function andWhere($col, $value, $operator = '=')
    {
        self::$sql .= " and $col $operator '$value'";
        return $this;
    }

    public function orWhere($col, $value, $operator = '=')
    {
        self::$sql .= " or $col $operator '$value'";
        return $this;
    }

    public static function insert($table, $value)
    {
        $col = implode(',', array_keys($value));
        $what = '';
        foreach ($value as $v) {
            $what .= "?,";
        }
        $what =  str_split($what, strlen($what) - 1)[0];
        $sql = "insert into $table ($col) values ($what)";
        self::$sql = $sql;
        $parm = array_values($value);
        $db = new DB();
        $db->query($parm);
        $id = self::$dbh->lastInsertId();
        return DB::table($table)->where("id", $id)->getOne();
    }

    public static function update($table, $value, $id)
    {
        $what = "";
        foreach ($value as $k => $v) {
            $what .= $k . "=?,";
        }
        $what = str_split($what, strlen($what) - 1)[0];
        $sql = "update $table set $what where id=$id";
        self::$sql = $sql;
        $db = new DB();
        $db->query(array_values($value));
        return DB::table($table)->where("id", $id)->getOne();
    }

    public static function delete($table, $id)
    {
        $sql = "delete from $table where id=$id";
        self::$sql = $sql;
        $db = new DB();
        $db->query();
        return true;
    }

    public static function raw($sql)
    {
        $db = new DB();
        self::$sql = $sql;
        return $db;
    }

    public function paginate($perPage)
    {
        if (!isset($_GET['page']) ||  $_GET['page'] < 1) {
            $pageNo = 1;
        } else {
            $pageNo = $_GET['page'];
        }

        $this->count();
        // echo self::$count;

        // $this->query();
        // $count = self::$res->rowCount();
        // echo $count;

        $index = ($pageNo - 1) * $perPage;
        self::$sql .= " limit $index,$perPage";

        $this->getAll();
        // print_r(self::$data);
        // $this->query();
        // self::$data = self::$res->fetchAll(PDO::FETCH_OBJ);
        // echo '<pre>';
        // print_r(self::$data);

        $prevPage = "?page=" . $pageNo - 1;
        $nextPage = "?page=" . $pageNo + 1;

        $data = [
            "data" => self::$data,
            "total" => self::$count,
            "prev_page" => $prevPage,
            "next_page" => $nextPage,
        ];

        return $data;
    }
}
