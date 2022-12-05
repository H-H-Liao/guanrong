<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>email 忘記密碼</title>
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
            left: 0;
            top: 0;
            height: calc(100% - 16px - 6px);
            width: calc(100% - 16px - 6px);
            margin: 8px;
            border: 3px solid #b2aacd;
            pointer-events: none;">
                <div class="confirm-card__logoblock" style=" padding: 12px;
            padding-top: 20px;
           background-color: #fbfcfe;     padding: 12px;
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
                        親愛的 {{$name}} (先生/小姐) 您好：
                        <br>
                        <div style="width:30px;display:inline-block"></div>剛剛您在「
                        <a href="{{ env('WEBSITE_URL') ?? '' }}" style="color: #d28fa7; font-weight: bold;">
                            {{ Settings::value('cht[website_title]')  }}
                        </a>」有發起重設密碼的請求，請點選下方連結重設您的新密碼，謝謝。
                        <a href="{{ route(app()->getLocale().'::member.resetPassword') }}?token={{ $token ?? ''}}">點我重設密碼</a>
                    </div>
                    <div class="confirm-card__info" style="  padding: 10px;
    font-size: 16px;
    font-weight: 300;
    overflow: auto;">

                    </div>

                </div>
                <div class="confirm-card__warntext" style="font-size: 10px;
    font-weight: 300;
    padding-left: 50px;">
                    *此為系統發送信，請勿直接回信，謝謝
                </div>
                <div class="confirm-card__com" style="width: auto; height: auto;padding: 2px 50px 20px 50px;font-weight: 300;font-size: 14px;">
                    <hr style="border: 1px solid #82715e;">
                    <div style="padding-left: 8px;">
                        <div class="confirm-card__comname" style="padding-bottom: 2px;letter-spacing: 1px;">
                            <a href=" {{ env('WEBSITE_URL') ?? '' }}" style=" text-decoration: none;
                        color: #000000;
                        font-weight: 300;">
                            {{ env('WEBSITE_NAME') ?? '' }}</a>
                        </div>
                        <div class="confirm-card__contact" style="font-size: 14px;padding-bottom: 8px;letter-spacing: 1px;">
                            <div>
                                <div class="dib">
                                    聯絡電話：<a href="tel:{{ env('WEBSITE_PHONE') ?? '' }}" style="text-decoration: none; color:#000000">{{ env('WEBSITE_PHONE') ?? '' }}
                                </a>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

</body>

</html>
