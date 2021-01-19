<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>練習</title>
</head>

<body>
    <link rel="stylesheet" href="css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../css/bootstrap.min.css" type="text/css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>

    <header>
        <h1 class="text-center">お問い合わせ</h1>
    </header>
    <main class="wrap input container">
        <form action="" method="POST">
            <section class="contact_sheet">
                <table>
                    <!-- お名前 -->
                    <tr class="name_area">
                        <th>お名前<span class="requied">*</span></th>
                        <td>
                            <input name="full_name" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['full_name'])) {
                                                                                                echo h($_SESSION['form_data']['full_name']);
                                                                                            } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['full_name'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['full_name']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- フリガナ -->
                    <tr class="kana_area">
                        <th>フリガナ<span class="requied">*</span></th>
                        <td>
                            <input name="kana" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['kana'])) {
                                                                                            echo h($_SESSION['form_data']['kana']);
                                                                                        } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['kana'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['kana']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 性別 -->
                    <tr class="sex_area">
                        <th>性別<span class="requied">*</span></th>
                        <td>
                            <?php
                            foreach ($sex as $key => $value) {
                                $checked = '';
                                //選択を維持する。
                                if (isset($_SESSION['form_data']['sex']) && $key == $_SESSION['form_data']['sex']) {
                                    $checked = 'checked=checked';
                                }
                            ?>
                                <input name="sex" type="radio" value="<?php echo $key; ?>" <?php echo $checked; ?>><?php echo $value; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['sex'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['sex']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 年齢 -->
                    <tr class="age_area">
                        <th>年齢<span class="requied">*</span></th>
                        <td>
                            <select name="age" class="age form-control">
                                <?php
                                foreach ($age as $key => $value) {
                                    $selected = '';
                                    //選択を維持する。
                                    if (isset($_SESSION['form_data']['age']) && $key == $_SESSION['form_data']['age']) {
                                        $selected = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['age'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['age']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 血液型 -->
                    <tr class="blood_type_area">
                        <th>血液型<span class="requied">*</span></th>
                        <td>
                            <?php
                            foreach ($blood_type as $key => $value) {
                                $checked = '';
                                //選択を維持する。
                                if (isset($_SESSION['form_data']['blood_type']) && $key == $_SESSION['form_data']['blood_type']) {
                                    $checked = 'checked=checked';
                                }
                            ?>
                                <input name="blood_type" type="radio" value="<?php echo $key; ?>" <?php echo $checked; ?>><?php echo $value; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['blood_type'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['blood_type']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 職業 -->
                    <tr class="job_area">
                        <th>職業<span class="requied">*</span></th>
                        <td>
                            <select name="job" class="job form-control">
                                <?php
                                foreach ($job as $key => $value) {
                                    $selected = '';
                                    //選択を維持する。
                                    if (isset($_SESSION['form_data']['job']) && $key == $_SESSION['form_data']['job']) {
                                        $selected = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['job'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['job']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 郵便番号 -->
                    <tr class="post_code_area">
                        <th>郵便番号<span class="requied">*</span></th>
                        <td>
                            <input name="post_code_1" type="text" class="post_code_1 form-control" value="<?php if (isset($_SESSION['form_data']['post_code_1'])) {
                                                                                                                echo h($_SESSION['form_data']['post_code_1']);
                                                                                                            } ?>">
                            <p>-</p>
                            <input name="post_code_2" type="text" class="post_code_2 form-control" value="<?php if (isset($_SESSION['form_data']['post_code_2'])) {
                                                                                                                echo h($_SESSION['form_data']['post_code_2']);
                                                                                                            } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['post_code'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['post_code']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 都道府県 -->
                    <tr class="prefecture_area">
                        <th>都道府県<span class="requied">*</span></th>
                        <td>
                            <select name="prefecture" class="prefecture form-control">
                                <?php
                                foreach ($prefecture as $key => $value) {
                                    $selected = '';
                                    //選択を維持する。
                                    if (isset($_SESSION['form_data']['prefecture']) && $key == $_SESSION['form_data']['prefecture']) {
                                        $selected = 'selected';
                                    }
                                ?>
                                    <option value="<?php echo $key; ?>" <?php echo $selected; ?>><?php echo $value; ?></option>
                                <?php } ?>
                            </select>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['prefecture'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['prefecture']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 住所 -->
                    <tr class="address_area">
                        <th>住所<span class="requied">*</span></th>
                        <td>
                            <input name="address" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['address'])) {
                                                                                                echo h($_SESSION['form_data']['address']);
                                                                                            } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['address'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['address']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- ビル・マンション名 -->
                    <tr class="address_other_area">
                        <th>ビル・マンション名</th>
                        <td>
                            <input name="address_other" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['address_other'])) {
                                                                                                    echo h($_SESSION['form_data']['address_other']);
                                                                                                } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['address_other'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['address_other']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 電話番号 -->
                    <tr class="phone_number_area">
                        <th>電話番号<span class="requied">*</span></th>
                        <td>
                            <input name="phone_number_1" type="text" class="phone_number_1 form-control" value="<?php
                                                                                                                if (isset($_SESSION['form_data']['phone_number_1'])) {
                                                                                                                    echo h($_SESSION['form_data']['phone_number_1']);
                                                                                                                } ?>">
                            <p>-</p>
                            <input name="phone_number_2" type="text" class="phone_number_2 form-control" value="<?php
                                                                                                                if (isset($_SESSION['form_data']['phone_number_2'])) {
                                                                                                                    echo h($_SESSION['form_data']['phone_number_2']);
                                                                                                                } ?>">
                            <p>-</p>
                            <input name="phone_number_3" type="text" class="phone_number_3 form-control" value="<?php
                                                                                                                if (isset($_SESSION['form_data']['phone_number_3'])) {
                                                                                                                    echo h($_SESSION['form_data']['phone_number_3']);
                                                                                                                } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['phone_number'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['phone_number']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- メールアドレス -->
                    <tr class="mail_area">
                        <th>メールアドレス<span class="requied">*</span></th>
                        <td>
                            <input name="mail" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['mail'])) {
                                                                                            echo h($_SESSION['form_data']['mail']);
                                                                                        } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['mail'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['mail']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- メールアドレス(確認用) -->
                    <tr class="mail_confirm_area">
                        <th>メールアドレス<span class="requied">*</span><br>(確認用)</th>
                        <td>
                            <input name="mail_confirm" type="text" class="form-control" value="<?php if (isset($_SESSION['form_data']['mail_confirm'])) {
                                                                                                    echo h($_SESSION['form_data']['mail_confirm']);
                                                                                                } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['mail_confirm'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['mail_confirm']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- 興味あるカテゴリー -->
                    <tr class="interest_category_area">
                        <th>興味あるカテゴリー<br>(複数選択可)</th>
                        <td>
                            <?php
                            foreach ($category as $key => $value) {
                                $checked = '';
                                if (isset($_SESSION['form_data']['interest_category'])) {
                                    if (in_array($key, $_SESSION['form_data']['interest_category'])) {
                                        //選択を維持する。
                                        $checked = 'checked=checked';
                                    }
                                }
                            ?>
                                <input type="checkbox" name="interest_category[]" value="<?php echo $key; ?>" <?php echo $checked; ?>><?php echo $value; ?>
                            <?php } ?>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['interest_category'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['interest_category']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- お問い合わせ -->
                    <tr class="contact_content_area">
                        <th>お問い合わせ<span class="requied">*</span></th>
                        <td>
                            <textarea name="contact_content" class="form-control" cols="50" rows="10"><?php if (isset($_SESSION['form_data']['contact_content'])) {
                                                                                                            echo h($_SESSION['form_data']['contact_content']);
                                                                                                        } ?></textarea>
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['contact_content'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['contact_content']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
            <section class="submit_btn_area text-center">
                <button type="submit" name="submit_top" class="submit_btn form-control btn btn-primary">入力内容を確認する</button>
            </section>
        </form>
    </main>
</body>

</html>