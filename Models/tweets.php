<?php
//
//ツイートデータを処理
//

/**
 * @param array
 * @return bool
 *
 */

function createTweet(array $data )
{
     //DB接続
     $mysqli = new mysqli(DB_HOST, DB_USER,DB_PASSWORD,DB_NAME);
     //接続エラーがある場合ー＞処理停止
     if($mysqli->connect_errno){
         echo'MYSQLの接続に失敗しました。:' .$mysqli ->connect_error ."/n";
         exit;
     }
     //新規登録のsqlクエリを作成
     $query ='INSERT INTO tweets (user_id, body,image_name)VALUES(?,?,?)';
 //プリペアドステートメントにクエリを登録
 $statement =$mysqli ->prepare($query);

 //var_dump($statement);
//exit;

 //プレースホルダにカラム値を紐付け（i=int,s=string）
 $statement->bind_param('iss', $data['user_id'], $data['body'], $data['image_name']);
 
 
 //クエリを実行
 $response = $statement->execute();
 if($response === false){
     echo'エラーメッセージ:' .$mysqli->error ."/n";
 }
 //DB接続を解放
 $statement->close();
 $mysqli -> close();

 return $response;
    }