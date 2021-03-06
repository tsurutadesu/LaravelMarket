<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  <p>{{ $info['user_name'] }} 様</p>
  <p>この度は「日本、暮らしの道具店」での商品ご購入、<br />誠にありがとうございます。</p>
  <h3>配達希望日時</h3>
  <p>【日付】　{{ $info['delivery_date'] }}<br />
  【時間帯】　{{ $info['delivery_time'] }}</p>
  <h3>ご注文情報</h3>
  <p style="border-bottom: 1px solid #ccc; width: 100%;"></p>
  <p>【商品合計】　{{ number_format($info['subtotal']) }}円<br />
  【送料】　{{ number_format($info['shipping_fee']) }}円<br />
  @if ($info['discount'] > 0)
    【クーポン】　{{ $info['discount'] }}円<br />
  @endif
  【注文合計】　{{ number_format($info['total']) }}円</p>
  <p style="border-top: 1px solid #ccc; width: 100%;"></p>
  <h3>配送先住所</h3>
  <p>【郵便番号】 〒 {{ $info['ship_zip_code'] }}<br />
  【住所】 　{{ $info['ship_address'] }}</p>
  <h3>配達伝票番号</h3>
  <p>【コード】　{{ $info['status_code'] }}</p>
  <p>商品について、何かご不明点などございましたら<br />
  当店までお問い合わせいただけますよう<br />
  どうぞよろしくお願いいたします。</p>
  <p>================================================================</p>
  <p>日本、暮らしの道具店</p>
  <p>https://nipponkurashi.com</p>
  <p>メールアドレス：nippon.kurashi@gmail.com</p>
  <p>電話番号：090-12345678（運営　鶴田和眞）</p>
  <p>営業時間：月～金 10：00-17：00</p>
  <p>※13：30～14：30はお昼休みをいただいています。</p>
  <p>================================================================</p>
</body>
</html>
