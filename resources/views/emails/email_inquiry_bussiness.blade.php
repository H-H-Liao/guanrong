<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>需求單已傳送成功</title>
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
            border: 3px solid #cccccc;">
                <div class="confirm-card__logoblock" style=" padding: 12px;
            padding-top: 20px; background-color: #fbfcfe;">
                    <img src="{{ asset('images/logo.jpg') }}" alt="" style="display: block;
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
                        <div style="width: 30px;display: inline-block;"></div> 親愛的{{ env('APP_NAME')}}您好，您有一封需求通知，以下為顧客所提出的需求：
                    </div>
                    <div class="confirm-card__info" style="  padding: 10px;
    font-size: 16px;
    font-weight: 300;
    overflow: auto;">
                        <div class="confirm-card__text" style="    padding: 2px;
    display: flex;
    justify-content: flex-start;
    align-items: center;">
                        </div>
                        <br>
                        <div class="confirm-card__text" style="
                            padding: 2px;
                            display: flex;
                            justify-content: flex-start;
                            align-items: center;">
                            <span style="width: 98px;
                                        font-weight: 400;
                                        display: flex;
                                        justify-content: flex-end;
                                        align-items: center;
                                        white-space: nowrap">
                                        聯絡人:</span>{{ $inquiry->username ?? '' }} 先生/小姐
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
                            white-space: nowrap">電話:</span>{{ $inquiry->phone??'未填寫'}}
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
                        white-space: nowrap">信箱:</span>{{ $inquiry->email??'未填寫'}}
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
                        white-space: nowrap">訊息:</span>{{ $inquiry->message??'未填寫'}}
                                            </div>
                        <br>

                        <div class="confirm-card__table" style=" overflow: auto;">
                            <table style="margin-top: 18px;
                                        width: 100%;
                                        border: 1px solid #cccccc;
                                        text-align: center;
                                        border-collapse: collapse;">
                                <tr>

                                    <th style="min-width: 50px;
                                    font-weight: 400;
                                    background-color: #cccccc;
                                    border-bottom: 1px solid #F1E8ED;
                                    color: white;
                                    letter-spacing: 2px;">品名</th>
                                    <th style="min-width: 50px;
                                    font-weight: 400;
                                    background-color: #cccccc;
                                    border-bottom: 1px solid #F1E8ED;
                                    color: white;
                                    letter-spacing: 2px;">商品型號</th>
                                    <th style="min-width: 50px;
                                    font-weight: 400;
                                    background-color: #cccccc;
                                    border-bottom: 1px solid #F1E8ED;
                                    color: white;
                                    letter-spacing: 2px;">數量</th>
                                </tr>
                                @isset($inquiry)
                                    @foreach($inquiry->item as $item)
                                        @if(isset($item->product))
                                        <tr>
                                            <td style="  font-weight: 300;
                                            background-color: #ffffff;
                                            padding: 3px 3px;">{{$item->product->title}}</td>
                                            <td style="  font-weight: 300;
                                            background-color: #ffffff;
                                            padding: 3px 3px;">{{$item->getSpecAttribute->title ??  "--"}}</td>
                                            <td style="  font-weight: 300;
                                            background-color: #ffffff;
                                            padding: 3px 3px;">{{$item->amount}}</td>
                                        </tr>
                                        @endif
                                    @endforeach
                                @endisset

                            </table>
                        </div>


                    </div>

                </div>
                <div class="confirm-card__warntext" style="font-size: 10px;
    font-weight: 300;
    padding-left: 50px;">
                    *此為系統發送信，請勿直接回信，謝謝
                </div>
                <div class="confirm-card__com" style=" width: auto;
    height: auto;
    padding: 2px 50px 20px 50px;
    font-weight: 300;
    font-size: 14px;">
                    <hr style="border: 1px solid #82715e;">
                    <div style="padding-left: 8px;">

                        <div class="confirm-card__contact" style="font-size: 14px;padding-bottom: 8px;letter-spacing: 1px;">
                            <div>
                                <div class="dib">
                                    聯絡電話： <a href="tel:0935521537" style="text-decoration: none; color: #000000;">0935-521537</a> </div>

                            </div>
                            <div>
                                <div class="dib">
                                    聯絡地址： <a href="https://goo.gl/maps/n6cmQ9wigMkkjMQK9" style="text-decoration: none; color:#000000" target="_blank">台中市西屯區西屯路二段256巷6號13樓之8</a>

                                </div>
                            </div>
                        </div>
                        <div class="confirm-card__comname" style="padding-bottom: 16px;letter-spacing: 1px;">技術提供：<img src="{{ asset('img/tonghelogo_small.png') }}" style="width:15px;height:15px; margin-right:1px;position:relative;top:2px;" alt="Logo Icon">
                            <a href="https://www.tonghe-find.com/" style="color: #326bce;">通和行銷股份有限公司</a>
                        </div>
                        <div class="confirm-card__copyright" style="text-align: center; font-size: 8px;">
                            Copyright © 2021 Tonghe Marketing Co.,Ltd All Rights Reserves.
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
</body>

</html>

</html>
