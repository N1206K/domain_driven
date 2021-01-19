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
        <h1 class="contact_list_title text-center">お問い合わせ一覧</h1>
    </header>
    <main class="wrap contact_list_area container">
        <form action="" method="POST">
            <section class="contact_sheet">
                <table>
                    <!-- お名前 -->
                    <tr class="name_area">
                        <th>お名前</th>
                        <td>
                            <input name="full_name" type="text" class="form-control" maxlength="255" value="<?php if (isset($_SESSION['full_name'])) {
                                                                                                                echo h($_SESSION['full_name']);
                                                                                                            } ?>">
                        </td>
                    </tr>
                    <!-- カナ -->
                    <tr class="kana_area">
                        <th>カナ</th>
                        <td>
                            <input name="kana" type="text" class="form-control" maxlength="255" value="<?php if (isset($_SESSION['kana'])) {
                                                                                                            echo h($_SESSION['kana']);
                                                                                                        } ?>">
                        </td>
                    </tr>
                    <!-- メールアドレス -->
                    <tr class="mail_area">
                        <th>メールアドレス</th>
                        <td>
                            <input name="mail" type="text" class="form-control" maxlength="255" value="<?php if (isset($_SESSION['mail'])) {
                                                                                                            echo h($_SESSION['mail']);
                                                                                                        } ?>">
                        </td>
                    </tr>
                </table>
            </section>
            <section class="submit_btn_area text-center">
                <button type="submit" class="submit_btn form-control btn btn-primary">絞り込み</button>
            </section>
            <section class="contact_lists">
                <div class="result_content_area">
                    <?php if ($count_result > 0) { ?>
                        <table class="table">
                            <tr>
                                <th>No</th>
                                <th>お名前</th>
                                <th>カナ</th>
                                <th>メールアドレス</th>
                                <th>お問い合わせ時間</th>
                            </tr>
                            <?php foreach ($rows as $value) { ?>
                                <tr>
                                    <td>
                                        <a href="/naito/admin/detail?contact_no=<?php echo h($value['contact_no']); ?>&page_id=<?php echo $now; ?>"><?php echo h($value['contact_no']); ?></a>
                                    </td>
                                    <td><?php echo h($value['name']); ?></td>
                                    <td><?php echo h($value['kana']); ?></td>
                                    <td>
                                        <a href="mailto:<?php echo h($value['mail']); ?>"><?php echo h($value['mail']); ?></a>
                                    </td>
                                    <td><?php echo h($value['modified']); ?></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <div class="paging_area text-center">
                            <!-- ひとつ前のリンクと最初へのリンクの処理 -->
                            <?php if ($now > 1) { ?>
                                <a href="/naito/admin/list?page_id=1">
                                    << </a><span>｜</span>
                                        <a href="/naito/admin/list?page_id=<?php echo $now - 1; ?>">
                                            < </a><span>｜</span>
                                            <?php } else { ?>
                                                <span>
                                                    << ｜</span>
                                                        <span>
                                                            < ｜</span>
                                                            <?php } ?>
                                                            <!-- ページネーションの表示件数の処理。表示件数は5件 -->
                                                            <?php
                                                            $difference_min = $now - 1;
                                                            $difference_max = $max_page - $now;

                                                            if ($difference_min < 4 && $difference_max > 4) { ?>
                                                                <div class="links_area">
                                                                    <?php for ($j = 1; $j <= 5; $j++) {
                                                                        if ($j == $now) { ?>
                                                                            <span><?php echo $j; ?></span>
                                                                        <?php } else { ?>
                                                                            <a href="/naito/admin/list?page_id=<?php echo $j ?>"><?php echo $j; ?></a>
                                                                    <?php }
                                                                    } ?>
                                                                    <span>...</span>
                                                                </div>
                                                            <?php } elseif ($difference_min > 4 && $difference_max < 4) { ?>
                                                                <div class="links_area">
                                                                    <span>...</span>
                                                                    <?php for ($j = $max_page - 4; $j <= $max_page; $j++) {
                                                                        if ($j == $now) { ?>
                                                                            <span><?php echo $j; ?></span>
                                                                        <?php } else { ?>
                                                                            <a href="/naito/admin/list?page_id=<?php echo $j ?>"><?php echo $j; ?></a>
                                                                    <?php }
                                                                    } ?>
                                                                </div>
                                                            <?php } elseif ($count_result <= 5) { ?>
                                                                <div class="links_area">
                                                                    <span>1</span>
                                                                </div>
                                                            <?php } else { ?>
                                                                <div class="links_area">
                                                                    <span>...</span>
                                                                    <a href="/naito/admin/list?page_id=<?php echo $now - 2; ?>"><?php echo $now - 2; ?></a>
                                                                    <a href="/naito/admin/list?page_id=<?php echo $now - 1; ?>"><?php echo $now - 1; ?></a>
                                                                    <span><?php echo $now; ?></span>
                                                                    <a href="/naito/admin/list?page_id=<?php echo $now + 1; ?>"><?php echo $now + 1; ?></a>
                                                                    <a href="/naito/admin/list?page_id=<?php echo $now + 2; ?>"><?php echo $now + 2; ?></a>
                                                                    <span>...</span>
                                                                </div>
                                                            <?php } ?>
                                                            <!-- ひとつ後のリンクと最後へのリンクの処理 -->
                                                            <?php if ($now < $max_page) { ?>
                                                                <a href="/naito/admin/list?page_id=<?php echo $now + 1; ?>">｜ > </a>
                                                                <a href="/naito/admin/list?page_id=<?php echo $max_page; ?>">｜ >> </a>
                                                            <?php } else { ?>
                                                                <span>｜ > </span>
                                                                <span>｜ >> </span>
                                                            <?php } ?>
                        </div>
                    <?php } else { ?>
                        <p class="alert alert-danger">該当する情報はありませんでした。</p>
                    <?php } ?>
                </div>
            </section>
        </form>
    </main>
</body>

</html>