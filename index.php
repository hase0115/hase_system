<?php
date_default_timezone_set('Asia/Tokyo'); //日付を日本基準とする
session_start(); // セッションを開始


// フォームから送信されたデータ取得
if (isset($_POST["koumoku_name"])) {

	$_SESSION['touroku_sousin'] = '1';
	
	include('sisan_touroku.php');

} else {
    // キーが存在しない場合の処理
}

if (isset($_SESSION['touroku_sousin'])) {
    // ページがリダイレクト後にロードされたときに実行
    $botan_hikassei = "<script>
window.onload = function() {
    var submitButton = document.getElementById('submit-button');
    submitButton.disabled = true;
    
    setTimeout(function() {
        submitButton.disabled = false;
    }, 2000); // 2秒後にボタンを再度活性化する
}
</script>";
   
	
    // セッションのフラグをクリア
	unset($_SESSION['touroku_sousin']);
	
} else {
    $botan_hikassei = '';
}

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>資産ページ</title>
    
    <?= $botan_hikassei ?> <!--ボタンを非活性-->
</head>
<body>


<h2>資産</h2>
<?php
	//資産を表示するPHP
	include('sisan_hyouzi.php');
?>


<h2>データ登録</h2>

<form action="" method="post">
    <label for="koumoku_name">項目:</label>
    <select id="koumoku_name" name="koumoku_name" required>
        <?php // プルダウンにデータベースから取得した項目を表示
        include('get_cdtb_koumoku.php');
        ?>
    </select>
    
    
    <label for="syusi_flg">収支:</label>
    <select id="syusi_flg" name="syusi_flg">
        <option value="1">支出</option>
        <option value="2">収入</option>
    </select>
    
    

    <label for="number">金額:</label>
    <input type="number" id="kingaku" name="kingaku" required>

	<label for="date">日付:</label>
	<input type="datetime-local" id="date" name="date" value="<?php echo date('Y-m-d\TH:i:s'); ?>" required>



    <!--ユーザ（非表示）-->
    <input type="hidden" id="user" name="user" value="hase" readonly>


    <input type="submit" id="submit-button" value="登録">
    
    
</form>
<?php

?>






<h2>収支履歴</h2>
<?php
	//資産を表示するPHP
	include('syusi_rireki.php');
?>


</body>
</html>