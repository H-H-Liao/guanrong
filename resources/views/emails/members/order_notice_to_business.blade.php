<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email 確認信 for 廠商</title>
    <!-- Google font -->
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+TC:wght@300;400&display=swap" rel="stylesheet">

</head>

<body style="height: 100%;
width: 100%;
margin: 0;
padding: 0;
position: relative;
font-family: 'Noto Sans TC', sans-serif;">
    <div class="wrapper-email theme-lefuda" style="    height: auto;
    max-width: 1000px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-right: auto;
    margin-left: auto;
    padding: 20px 0px;">

        <div class="confirm-card confirm-card--ent" style=" position: relative;
        width: 95%;
        height: auto;
        display: block;
        margin-right: auto;
        margin-left: auto;
        box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.25);">
            <div class="confirm-card__edge" style="
            pointer-events: none;
            left: 0;
            top: 0;
            height: calc(100% - 16px - 6px);
            width: calc(100% - 16px - 6px);
            margin: 8px;
            border: 3px solid #b2aacd;">
                <div class="confirm-card__logoblock" style=" padding: 12px;
            padding-top: 20px; background-color: #fbfcfe;">
                    <img src="{{ asset('images/logo.png') }}" alt="" style="display: block;
                width: 200px;
                margin-left: auto;
                margin-right: auto;
                cursor: none;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
                -webkit-user-drag: none;">
                </div>
                <div class="confirm-card__content" style="padding: 60px 50px;
            padding-bottom: 70px;
            letter-spacing: 1px;">
                    <div class="confirm-card__context" style="font-size: 16px;
    font-weight: 300;
    line-height: 32px;">
                        <div style="width: 30px;display: inline-block;"></div> 親愛的貴公司您好，以下是客戶的新進訂單資訊：
                    </div>
                    <div class="confirm-card__info" style="  padding: 10px;
    font-size: 16px;
    font-weight: 300;
    overflow: auto;">
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂單編號：</span>{{$order->serial_number}}
                        </div>
                        <br>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
      @php
      $orderAddress=$order->getOrderAddress ;
     @endphp
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂購人姓名：</span>{{ $orderAddress->name ?? '' }} 先生/小姐
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂購人市話：</span>{{$orderAddress->phone ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂購人手機：</span>{{$orderAddress->mobilephone ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂購人信箱：</span>{{$orderAddress->email ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">訂購人地址：</span>{{$orderAddress->city ?? ''}}{{$orderAddress->town ?? ''}}{{$orderAddress->address ?? ''}}
                        </div>
                        <br>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
        @php
        $recipientAddress=$order->getRecipientAddress;
        @endphp
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">收貨人姓名：</span>{{$recipientAddress->name ?? ''}} 先生/小姐
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">收貨人市話：</span>{{$recipientAddress->phone ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">收貨人手機：</span>{{$recipientAddress->mobilephone ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">收貨人信箱：</span>{{$recipientAddress->email ?? ''}}
                        </div>
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                            <span style="width: 98px;
    font-weight: 400;
    display: flex;
    justify-content: flex-end;
    align-items: center;
    white-space: nowrap">收貨人地址：</span>{{$recipientAddress->city ?? ''}}{{$recipientAddress->town ?? ''}}{{$recipientAddress->addr ?? ''}}
                        </div>
                        <br>
                        <div class="confirm-card__text confirm-card__text2" style="display: block;">
                            <span style="  display: block;">需求說明：</span>{{$order->memo ?? ''}}
                        </div>

                        <div class="confirm-card__table" style=" overflow: auto;">
                            <table style="margin-top: 18px;
                        width: 100%;
                        border: 1px solid #9780b9;
                        text-align: center;
                        border-collapse: collapse;">
                                <tr>
                                    <th style="min-width: 50px;
    font-weight: 400;
    background-color: #9780b9;
    border-bottom: 1px solid #F1E8ED;
    color: white;
    letter-spacing: 2px;">品名</th>
                                    <th style="min-width: 50px;
    font-weight: 400;
    background-color: #9780b9;
    border-bottom: 1px solid #F1E8ED;
    color: white;
    letter-spacing: 2px;">單價</th>
                                    <th style="min-width: 50px;
    font-weight: 400;
    background-color: #9780b9;
    border-bottom: 1px solid #F1E8ED;
    color: white;
    letter-spacing: 2px;">數量</th>
                                    <th style="min-width: 50px;
    font-weight: 400;
    background-color: #9780b9;
    border-bottom: 1px solid #F1E8ED;
    color: white;
    letter-spacing: 2px;">小計</th>
                                </tr>
                                @foreach($order->orderItem as $pItem)
                                <tr>
                                    <td style="  font-weight: 300;
    background-color: #ffffff;
    padding: 3px 3px;">{{$pItem->shopproduct_name}}</td>
                                    <td style="  font-weight: 300;
    background-color: #ffffff;
    padding: 3px 3px;">${{$pItem->price}}</td>
                                    <td style="  font-weight: 300;
    background-color: #ffffff;
    padding: 3px 3px;">{{$pItem->amount}}</td>
                                    <td style="  font-weight: 300;
    background-color: #ffffff;
    padding: 3px 3px;">${{$pItem->price*$pItem->amount}}</td>
                                </tr>  @endforeach

                            </table>
                        </div>
                        <div class="confirm-card__total" style="float: right;
    margin-top: 4px;
    margin-right: 3px;
    font-weight: 300;
    padding: 3px 3px;">
                            <span style=" font-weight: 400;">總計</span> ${{$order->sum}}
                        </div>

                    </div>

                </div>
                <div class="confirm-card__warntext" style="font-size: 10px;
    font-weight: 300;
    padding-left: 50px;">
                    *此為系統發送信，請勿直接回信，謝謝
                </div>
                @include('template.emails.footer')
            </div>

        </div>
    </div>
</body>

</html>
