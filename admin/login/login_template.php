<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <title>練習(管理画面)</title>
</head>

<body>
    <link rel="stylesheet" href="../css/style.css" type="text/css" media="screen">
    <link rel="stylesheet" href="../../css/bootstrap.min.css" type="text/css" media="screen">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>

    <header>
        <h1 class="text-center">ログイン画面</h1>
    </header>
    <main class="wrap input container">
        <form action="" method="POST">
            <section class="contact_sheet col-sm-12">
                <table>
                    <!-- ログインID -->
                    <tr class="login_id_area">
                        <th>ログインID</th>
                        <td>
                            <input name="login_id" type="text" class="form-control" value="<?php if (isset($_SESSION['login_data']['login_id'])) {
                                                                                                echo h($_SESSION['login_data']['login_id']);
                                                                                            } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['login_id'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['login_id']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- パスワード -->
                    <tr class="password_area">
                        <th>パスワード</th>
                        <td>
                            <input name="password" type="password" class="form-control" value="<?php if (isset($_SESSION['login_data']['password'])) {
                                                                                                    echo h($_SESSION['login_data']['password']);
                                                                                                } ?>">
                        </td>
                    </tr>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['password'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['password']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                    <!-- エラーメッセージ -->
                    <?php if (!empty($error_message['login_error'])) { ?>
                        <tr>
                            <th></th>
                            <td>
                                <p class="alert alert-danger"><?php echo $error_message['login_error']; ?></p>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </section>
            <section class="submit_btn_area text-center col-sm-12">
                <button type="submit" name="submit_login" class="submit_btn form-control btn btn-primary">ログイン</button>
            </section>
        </form>
    </main>
</body>

</html>