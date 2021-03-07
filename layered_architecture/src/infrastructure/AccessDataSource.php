<?php
class AccessDataSource
{
    private $db_info;

    //DB接続用メソッド
    public function connect_pdo()
    {
        $this->db_info = array(
            'database' => 'hoge',
            'host'     => 'localhost',
            'username' => 'hoge',
            'password' => 'hoge',
            'charset' => 'utf8'
        );

        $dsn      = 'mysql:dbname=' . $this->db_info['database'] . ';host=' . $this->db_info['host'] . ';charset=' . $this->db_info['charset'];
        $user     = $this->db_info['username'];
        $password = $this->db_info['password'];
        $option   = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false);

        try {
            $pdo = new PDO($dsn, $user, $password, $option);
        } catch (Exception $e) {
            echo 'error' . $e->getMesseage;
            exit();
        }

        return $pdo;
    }

    public function insert($form_data)
    {
        $sql =  <<< EOF
INSERT INTO
    naito_contact_info (
        name,
        kana,
        sex,
        age,
        blood_type,
        job,
        zip1,
        zip2,
        address1,
        address2,
        address3,
        tel,
        mail,
        category,
        info,
        created,
        modified
    )
VALUES (
    :name,
    :kana,
    :sex,
    :age,
    :blood_type,
    :job,
    :zip1,
    :zip2,
    :address1,
    :address2,
    :address3,
    :tel,
    :mail,
    :category,
    :info,
    :created,
    :modified
);
EOF;
        //sql実行
        try {
            $pdo  = connect_pdo($this->db_info);
            $stmh = $pdo->prepare($sql);
            $stmh->bindParam(':name', $form_data->full_name, PDO::PARAM_STR);
            $stmh->bindParam(':kana', $form_data->kana, PDO::PARAM_STR);
            $stmh->bindParam(':sex', $form_data->sex, PDO::PARAM_INT);
            $stmh->bindParam(':age', $form_data->age, PDO::PARAM_INT);
            $stmh->bindParam(':blood_type', $form_data->blood_type, PDO::PARAM_INT);
            $stmh->bindParam(':job', $form_data->job, PDO::PARAM_INT);
            $stmh->bindParam(':zip1', $form_data->zip1, PDO::PARAM_STR);
            $stmh->bindParam(':zip2', $form_data->zip2, PDO::PARAM_STR);
            $stmh->bindParam(':address1', $form_data->address1, PDO::PARAM_INT);
            $stmh->bindParam(':address2', $form_data->address2, PDO::PARAM_STR);
            $stmh->bindParam(':address3', $form_data->address3, PDO::PARAM_STR);
            $stmh->bindParam(':tel', $form_data->tel, PDO::PARAM_STR);
            $stmh->bindParam(':mail', $form_data->mail, PDO::PARAM_STR);
            $stmh->bindParam(':category', $form_data->category, PDO::PARAM_STR);
            $stmh->bindParam(':info', $form_data->info, PDO::PARAM_STR);
            $stmh->bindParam(':created', $form_data->created, PDO::PARAM_STR);
            $stmh->bindParam(':modified', $form_data->modified, PDO::PARAM_STR);
            $stmh->execute();
        } catch (PDOException $Exception) {
            die('エラー：' . $Exception->getMessage());
        }
    }
}
