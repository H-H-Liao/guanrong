<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email 確認信 for 客戶</title>
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

        <div class="confirm-card" style=" position: relative;
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
            border: 3px solid  #3F0000;">
                <div class="confirm-card__logoblock" style="  padding: 12px;
            padding-top: 20px;
           background-color: #fbfcfe; padding: 12px;
    padding-top: 20px;">
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
                        親愛的 {{$username}} (先生/小姐)您好:<br>
                        <div style="width: 30px; display:inline-block"></div>
                        非常感謝您購買我們的產品，我們已收到您的訂單，將盡快為您安排出貨，以下是您這次購買的訂單編號「
                        <span style="color:#b99f62;">{{$id}}</span>」，如欲查詢，可至
                        <a href="{{ env('APP_URL') ?? '' }}" style="color: #EB0000; font-weight: bold;">
                            {{ Settings::value('website_title')  }}
                        </a>
                            登入後，至「會員專區」的「訂單查詢」裡查詢訂單資訊。
                    </div>
                    <br><br>
                    <div class="confirm-card__context" style="font-size: 16px;
    font-weight: 300;
    line-height: 32px;margin-top: 20px;">
                        如有任何問題，歡迎隨時來電詢問。<br>祝福您有個美好的一天！
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

    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>

</body>


</html>
