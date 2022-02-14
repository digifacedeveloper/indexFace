# indexFace
Add  FaceData to Collection
顔認証サービスDigiFace専用のSDK

＜目的＞
顔データに紐づけるユーザー固有のIDと画像をアップロードしてコレクションに顔のデータを登録します。

＜APIの概要＞
【認証方式】 APIキー方式で認証します。リクエストには下記HTTPヘッダを指定します。
【プロトコル】　　HTTPS
【リクエストURL】 https://api.digiface.jp/put
【メソッド】 POST
【リクエストパラメータ】 Body
【パラメータ名】
１）uid （required）
任意のユニークID 半角英数字（記号は-_のみ可）桁数に制限なし

２）myphoto （required）
顔JPG画像をBASE64エンコードした文字列
先頭のData-URL宣言不要(例 date:image/jpg:base64)

＜サンプルコード＞
HTML+PHP
