<!doctype html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>DIGIFACE-顔登録SDK（デモ用）</title>
<link rel="stylesheet" href="css/regist.css">
</head>
<body>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['userfile']) && $_FILES['userfile']['error'] == UPLOAD_ERR_OK && is_uploaded_file($_FILES['userfile']['tmp_name']) && (!empty($_POST['UID'])) ) {

    $file_name=$_FILES['userfile']['tmp_name'];
    // base64エンコード
    $myphoto = base64_encode(file_get_contents($file_name));
    $uid='Demo'.date("Ymd").$_POST['UID'];
    $data_demo = array(
        'uid'=>$uid,
        'myphoto'=>$myphoto
    );
    $data_json_demo = json_encode($data_demo,JSON_NUMERIC_CHECK);

    $ch_demo = curl_init();
    curl_setopt($ch_demo, CURLOPT_HTTPHEADER, array('X-Api-Key: <YOUR API KEY>'));
    curl_setopt($ch_demo, CURLOPT_CUSTOMREQUEST, 'POST');
    curl_setopt($ch_demo, CURLOPT_POSTFIELDS, $data_json_demo);
    curl_setopt($ch_demo, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch_demo, CURLOPT_URL, 'https://api.digiface.jp/put');
    $result_demo=curl_exec($ch_demo);
    curl_close($ch_demo);
    
echo '<div class="success">登録が完了しました。<br>認証端末にてご確認いただけます</div>';
echo "<input type=\"button\" onclick=\"location.href='put_demo.php'\" value=\"戻る\" class=\"button02\">";
exit();
}
?>
<div class="container">
<h1>DIGIFACE<br>顔登録</h1>
<br>
<img src="images/icon-192.png">

<form enctype="multipart/form-data" action="put_demo.php" method="POST">
<br>
<span style="color:red;">半角英数字</span>でお名前を入力してください<br><input pattern="^[0-9A-Za-z]+$" name="UID" style="width:100px; height:25px; padding:2px;">
<br><br>
<div class="file">
写真を撮影
<input name="userfile" type="file" accept="image/*" capture="user">
</div>
<input type="submit" value="アップロード" class="button02">
</form>
<br>
<h2>推奨顔画像について</h2>
<textarea readonly>
●両目が開いて見える状態
●顔がピンぼけいない状態
●顔全体が見切れていない状態
●頭全体と肩が含まれている状態
●ヘッドバンドやマスクなど、顔を遮るものは避けてください
●顔が画像の大部分を占めている画像を推奨します
●カラーイメージを使用してください
●影などの陰影がなく、照明が顔に均一に当たっている状態
●背景とのコントラストが十分である状態
●高コントラストのモノクロの背景を推奨
●口を閉じて、わずかにほほ笑むかほほ笑まない中立的な表情を持つ顔を推奨
●明るくシャープな画像を推奨
●被写体やカメラモーションのせいでぼやけている可能性がある画像はできるだけ使用しないでください
</textarea>
<p><a href="https://digisurf.co.jp/privacy-policy.html" target="_black">プライバシーポリシー</a></p>
<br>
&copy; 2021 Digisurf Inc.
</div>
</body>
</html>
