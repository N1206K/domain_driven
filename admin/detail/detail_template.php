<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>練習</title>
</head>

<body>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" media="screen">
    <script src="../../js/bootstrap.min.js"></script>

    <header class="confirm_header">
        <h1 class="text-center">お問い合わせ内容の確認</h1>
    </header>
    <main class="wrap confirm container">
        <form action="" method="POST">
            <section class="contact_sheet">
                <p class="text-center">以下の内容でよろしければ「送信する」ボタンを押してください。</p>
                <p class="text-center">修正する場合は「戻る」ボタンを押して入力画面へお戻りください。</p>
            </section>
            <section class="contact_sheet">
                <h2>お問い合わせ内容</h2>
                <table>
                    <tr class="name_area">
                        <th>お問い合わせNO</th>
                        <td><?php echo h($confirm_data['contact_no']); ?></td>
                    </tr>
                    <tr class="name_area">
                        <th>お名前</th>
                        <td><?php echo h($confirm_data['name']); ?></td>
                    </tr>
                    <tr class="kana_area">
                        <th>フリガナ</th>
                        <td><?php echo h($confirm_data['kana']); ?></td>
                    </tr>
                    <tr class="sex_area">
                        <th>性別</th>
                        <td><?php echo h($sex[$confirm_data['sex']]); ?></td>
                    </tr>
                    <tr class="age_area">
                        <th>年齢</th>
                        <td><?php echo h($age[$confirm_data['age']]); ?></td>
                    </tr>
                    <tr class="blood_type_area">
                        <th>血液型</th>
                        <td><?php echo h($blood_type[$confirm_data['blood_type']]); ?></td>
                    </tr>
                    <tr class="job_area">
                        <th>職業</th>
                        <td><?php echo h($job[$confirm_data['job']]); ?></td>
                    </tr>
                    <tr class="post_code_area">
                        <th>郵便番号</th>
                        <td><?php echo h($confirm_data['post_code']); ?></td>
                    </tr>
                    <tr class="address_area">
                        <th>住所</th>
                        <td><?php echo h($confirm_data['pref']); ?></td>
                    </tr>
                    <tr class="address_other_area">
                        <th>ビル・マンション名</th>
                        <td><?php echo h($confirm_data['address3']); ?></td>
                    </tr>
                    <tr class="phone_number_area">
                        <th>電話番号</th>
                        <td><?php echo h($confirm_data['tel']); ?></td>
                    </tr>
                    <tr class="mail_area">
                        <th>メールアドレス</th>
                        <td><?php echo h($confirm_data['mail']); ?></td>
                    </tr>
                    <tr class="interest_category_area">
                        <th>興味あるカテゴリー</th>
                        <td>
                            <?php
                            $category_text = '';
                            //興味あるカテゴリーを表示用に設定
                            if (!empty($confirm_data['interest_category'])) {
                                foreach ($confirm_data['interest_category'] as $value) {
                                    if (empty($category_text)) {
                                        $category_text = $category[$value];
                                    } else {
                                        $category_text .= PHP_EOL . $category[$value];
                                    }
                                }
                            }
                            echo nl2br(h($category_text));
                            ?>
                        </td>
                    </tr>
                    <tr class="contact_content_area">
                        <th>お問い合わせ</th>
                        <td><?php echo nl2br(h($confirm_data['info'])); ?></td>
                    </tr>
                    <tr class="contact_content_area">
                        <th>お問い合わせ時間</th>
                        <td>
                            <?php
                            $created_date = '';
                            //お問い合わせ日時を表示用に設定
                            foreach ($confirm_data['created_date'] as $value) {
                                if (empty($created_date)) {
                                    $created_date = $value;
                                } else {
                                    $created_date .= PHP_EOL . $value;
                                }
                            }
                            echo nl2br(h($created_date));
                            ?>
                        </td>
                    </tr>
                </table>
            </section>
            <section class="submit_btn_area text-center">
                <button type="button" onclick="location.href='/naito/admin/list?page_id=<?php echo $get_data['page_id']; ?>'" class="form-control btn btn-danger">戻る</button>
            </section>
        </form>
    </main>
</body>

</html>