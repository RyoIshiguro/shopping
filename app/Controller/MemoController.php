<?php 
  //Remaining task 
  // done $current_userの値を編集時にアップデートする。moneyしか対応してないので書き込みが必要
  
  //user bought products which are in the cart. need condition,check after parches cart is empty or not. 
  //empty = cart status should be 2 
  //still product remains in the cart = cart status should be 0
  
  //admin screen's pagination





  //登録ができなかった時のミス
  //DBのcolumn名とinputで指定してたecho $this->Form->input('first_name');の名前が違った。
  //
  
  // CakePHPで開発をしている時にデータベースの一部のデータが更新されないということがありました。
  // 
  // データベースのフィールドを追加し、CakePHPでデータを更新すると新しく追加したフィールドだけが更新されないのです。
  // しかし、他のフィールドは正常に更新されます。
  // 
  // どこか間違えている箇所があると思い、何度もソースを見直したのですが、原因が分からずにいました。
  // 
  // なので「app」配下のディレクトリを一つ一つ確認していたら、怪しいと思ったファイルを発見しました。
  // 下記のディレクトリ内にデータベースのテーブル構造を格納するモデルのキャッシュファイルがあったのです。
  // 
  // app/tmp/cache/models
  // そのキャッシュファイルを削除したら正常にデータが更新されました。
  
  //バリデーションを無視する方法
  //if($this->Loophole->save($data,false)として第二引数にfalseを渡すとvalidationを無視することが可能
  
  //cakephpのハッシュ製造の元担っている。
  //Config/core.php の Security.saltに手を加えると同じ文字でも違う文字列でパスワードをハッシュ化する
  // Config/core.php の Security.salt
  // と Security.cipherSeed は変えなさい、とありますが、CakePHP の
  // ハッシュ機能がこれらの値を元にしているようです。
  
  //Blowfishはパスワードがハッシュが変わり続ける事件があって使わなかった。
  //find('first','')で特定のものを照合可能。 
  //findの後にarray()conditionを追加することで、特定が可能 
 ?>