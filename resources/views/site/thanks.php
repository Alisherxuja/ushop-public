<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<style>
    body {
        margin: 0;
        padding: 0;
        background: #000;
        overflow: hidden;
    }

    .pyro > .before, .pyro > .after {
        position: absolute;
        width: 5px;
        height: 5px;
        border-radius: 50%;
        box-shadow: 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff, 0 0 #fff;
        -moz-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -webkit-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -o-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        -ms-animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
        animation: 1s bang ease-out infinite backwards, 1s gravity ease-in infinite backwards, 5s position linear infinite backwards;
    }

    .pyro > .after {
        -moz-animation-delay: 1.25s, 1.25s, 1.25s;
        -webkit-animation-delay: 1.25s, 1.25s, 1.25s;
        -o-animation-delay: 1.25s, 1.25s, 1.25s;
        -ms-animation-delay: 1.25s, 1.25s, 1.25s;
        animation-delay: 1.25s, 1.25s, 1.25s;
        -moz-animation-duration: 1.25s, 1.25s, 6.25s;
        -webkit-animation-duration: 1.25s, 1.25s, 6.25s;
        -o-animation-duration: 1.25s, 1.25s, 6.25s;
        -ms-animation-duration: 1.25s, 1.25s, 6.25s;
        animation-duration: 1.25s, 1.25s, 6.25s;
    }

    @-webkit-keyframes bang {
        to {
            box-shadow: -169px -203.6666666667px #f2ff00, -69px -226.6666666667px #00a6ff, 171px 0.3333333333px #80f, -28px -39.6666666667px #0f1, 138px -339.6666666667px #006fff, -156px -233.6666666667px #00ffbf, -103px -19.6666666667px #ff5900, -90px -363.6666666667px #0f4, -37px -235.6666666667px #95ff00, -60px -75.6666666667px #0800ff, 224px -93.6666666667px #0800ff, -110px -59.6666666667px #1f0, -196px 41.3333333333px #00ff48, 178px -357.6666666667px #4cff00, 249px -354.6666666667px #ff6200, -122px -411.6666666667px #ff0084, -203px -46.6666666667px #fff200, 44px 77.3333333333px #ffb300, 194px -158.6666666667px #ff0040, 165px -405.6666666667px #5f0, 49px -209.6666666667px #5900ff, 214px -134.6666666667px #00ff09, -117px -153.6666666667px #ff6f00, 15px -167.6666666667px #ff0d00, -36px -277.6666666667px #00f2ff, 63px -371.6666666667px #2f00ff, 177px -231.6666666667px #2f0, 60px -362.6666666667px #c400ff, 46px -32.6666666667px #b0f, -53px -82.6666666667px #0059ff, -82px -23.6666666667px #ff7b00, -26px -156.6666666667px #0037ff, -169px -39.6666666667px #ff8400, 49px -220.6666666667px #ff006a, 109px -2.6666666667px #00ff0d, 137px -221.6666666667px #fd0, -2px 41.3333333333px #d5ff00, 36px -116.6666666667px #ff0062, 200px 79.3333333333px #aeff00, -108px 72.3333333333px #1900ff, -179px 42.3333333333px #ff001e, -102px -346.6666666667px #00ffae, -53px -306.6666666667px #c400ff, -193px -81.6666666667px #fbff00, 174px -140.6666666667px #ff002f, -211px -87.6666666667px #ff9500, -104px 73.3333333333px #f0f, -196px -198.6666666667px #0019ff, -4px 72.3333333333px #8cff00, 238px -274.6666666667px #0f2, -27px -21.6666666667px #00eaff;
        }
    }

    @-moz-keyframes bang {
        to {
            box-shadow: -169px -203.6666666667px #f2ff00, -69px -226.6666666667px #00a6ff, 171px 0.3333333333px #80f, -28px -39.6666666667px #0f1, 138px -339.6666666667px #006fff, -156px -233.6666666667px #00ffbf, -103px -19.6666666667px #ff5900, -90px -363.6666666667px #0f4, -37px -235.6666666667px #95ff00, -60px -75.6666666667px #0800ff, 224px -93.6666666667px #0800ff, -110px -59.6666666667px #1f0, -196px 41.3333333333px #00ff48, 178px -357.6666666667px #4cff00, 249px -354.6666666667px #ff6200, -122px -411.6666666667px #ff0084, -203px -46.6666666667px #fff200, 44px 77.3333333333px #ffb300, 194px -158.6666666667px #ff0040, 165px -405.6666666667px #5f0, 49px -209.6666666667px #5900ff, 214px -134.6666666667px #00ff09, -117px -153.6666666667px #ff6f00, 15px -167.6666666667px #ff0d00, -36px -277.6666666667px #00f2ff, 63px -371.6666666667px #2f00ff, 177px -231.6666666667px #2f0, 60px -362.6666666667px #c400ff, 46px -32.6666666667px #b0f, -53px -82.6666666667px #0059ff, -82px -23.6666666667px #ff7b00, -26px -156.6666666667px #0037ff, -169px -39.6666666667px #ff8400, 49px -220.6666666667px #ff006a, 109px -2.6666666667px #00ff0d, 137px -221.6666666667px #fd0, -2px 41.3333333333px #d5ff00, 36px -116.6666666667px #ff0062, 200px 79.3333333333px #aeff00, -108px 72.3333333333px #1900ff, -179px 42.3333333333px #ff001e, -102px -346.6666666667px #00ffae, -53px -306.6666666667px #c400ff, -193px -81.6666666667px #fbff00, 174px -140.6666666667px #ff002f, -211px -87.6666666667px #ff9500, -104px 73.3333333333px #f0f, -196px -198.6666666667px #0019ff, -4px 72.3333333333px #8cff00, 238px -274.6666666667px #0f2, -27px -21.6666666667px #00eaff;
        }
    }

    @-o-keyframes bang {
        to {
            box-shadow: -169px -203.6666666667px #f2ff00, -69px -226.6666666667px #00a6ff, 171px 0.3333333333px #80f, -28px -39.6666666667px #0f1, 138px -339.6666666667px #006fff, -156px -233.6666666667px #00ffbf, -103px -19.6666666667px #ff5900, -90px -363.6666666667px #0f4, -37px -235.6666666667px #95ff00, -60px -75.6666666667px #0800ff, 224px -93.6666666667px #0800ff, -110px -59.6666666667px #1f0, -196px 41.3333333333px #00ff48, 178px -357.6666666667px #4cff00, 249px -354.6666666667px #ff6200, -122px -411.6666666667px #ff0084, -203px -46.6666666667px #fff200, 44px 77.3333333333px #ffb300, 194px -158.6666666667px #ff0040, 165px -405.6666666667px #5f0, 49px -209.6666666667px #5900ff, 214px -134.6666666667px #00ff09, -117px -153.6666666667px #ff6f00, 15px -167.6666666667px #ff0d00, -36px -277.6666666667px #00f2ff, 63px -371.6666666667px #2f00ff, 177px -231.6666666667px #2f0, 60px -362.6666666667px #c400ff, 46px -32.6666666667px #b0f, -53px -82.6666666667px #0059ff, -82px -23.6666666667px #ff7b00, -26px -156.6666666667px #0037ff, -169px -39.6666666667px #ff8400, 49px -220.6666666667px #ff006a, 109px -2.6666666667px #00ff0d, 137px -221.6666666667px #fd0, -2px 41.3333333333px #d5ff00, 36px -116.6666666667px #ff0062, 200px 79.3333333333px #aeff00, -108px 72.3333333333px #1900ff, -179px 42.3333333333px #ff001e, -102px -346.6666666667px #00ffae, -53px -306.6666666667px #c400ff, -193px -81.6666666667px #fbff00, 174px -140.6666666667px #ff002f, -211px -87.6666666667px #ff9500, -104px 73.3333333333px #f0f, -196px -198.6666666667px #0019ff, -4px 72.3333333333px #8cff00, 238px -274.6666666667px #0f2, -27px -21.6666666667px #00eaff;
        }
    }

    @-ms-keyframes bang {
        to {
            box-shadow: -169px -203.6666666667px #f2ff00, -69px -226.6666666667px #00a6ff, 171px 0.3333333333px #80f, -28px -39.6666666667px #0f1, 138px -339.6666666667px #006fff, -156px -233.6666666667px #00ffbf, -103px -19.6666666667px #ff5900, -90px -363.6666666667px #0f4, -37px -235.6666666667px #95ff00, -60px -75.6666666667px #0800ff, 224px -93.6666666667px #0800ff, -110px -59.6666666667px #1f0, -196px 41.3333333333px #00ff48, 178px -357.6666666667px #4cff00, 249px -354.6666666667px #ff6200, -122px -411.6666666667px #ff0084, -203px -46.6666666667px #fff200, 44px 77.3333333333px #ffb300, 194px -158.6666666667px #ff0040, 165px -405.6666666667px #5f0, 49px -209.6666666667px #5900ff, 214px -134.6666666667px #00ff09, -117px -153.6666666667px #ff6f00, 15px -167.6666666667px #ff0d00, -36px -277.6666666667px #00f2ff, 63px -371.6666666667px #2f00ff, 177px -231.6666666667px #2f0, 60px -362.6666666667px #c400ff, 46px -32.6666666667px #b0f, -53px -82.6666666667px #0059ff, -82px -23.6666666667px #ff7b00, -26px -156.6666666667px #0037ff, -169px -39.6666666667px #ff8400, 49px -220.6666666667px #ff006a, 109px -2.6666666667px #00ff0d, 137px -221.6666666667px #fd0, -2px 41.3333333333px #d5ff00, 36px -116.6666666667px #ff0062, 200px 79.3333333333px #aeff00, -108px 72.3333333333px #1900ff, -179px 42.3333333333px #ff001e, -102px -346.6666666667px #00ffae, -53px -306.6666666667px #c400ff, -193px -81.6666666667px #fbff00, 174px -140.6666666667px #ff002f, -211px -87.6666666667px #ff9500, -104px 73.3333333333px #f0f, -196px -198.6666666667px #0019ff, -4px 72.3333333333px #8cff00, 238px -274.6666666667px #0f2, -27px -21.6666666667px #00eaff;
        }
    }

    @keyframes bang {
        to {
            box-shadow: -169px -203.6666666667px #f2ff00, -69px -226.6666666667px #00a6ff, 171px 0.3333333333px #80f, -28px -39.6666666667px #0f1, 138px -339.6666666667px #006fff, -156px -233.6666666667px #00ffbf, -103px -19.6666666667px #ff5900, -90px -363.6666666667px #0f4, -37px -235.6666666667px #95ff00, -60px -75.6666666667px #0800ff, 224px -93.6666666667px #0800ff, -110px -59.6666666667px #1f0, -196px 41.3333333333px #00ff48, 178px -357.6666666667px #4cff00, 249px -354.6666666667px #ff6200, -122px -411.6666666667px #ff0084, -203px -46.6666666667px #fff200, 44px 77.3333333333px #ffb300, 194px -158.6666666667px #ff0040, 165px -405.6666666667px #5f0, 49px -209.6666666667px #5900ff, 214px -134.6666666667px #00ff09, -117px -153.6666666667px #ff6f00, 15px -167.6666666667px #ff0d00, -36px -277.6666666667px #00f2ff, 63px -371.6666666667px #2f00ff, 177px -231.6666666667px #2f0, 60px -362.6666666667px #c400ff, 46px -32.6666666667px #b0f, -53px -82.6666666667px #0059ff, -82px -23.6666666667px #ff7b00, -26px -156.6666666667px #0037ff, -169px -39.6666666667px #ff8400, 49px -220.6666666667px #ff006a, 109px -2.6666666667px #00ff0d, 137px -221.6666666667px #fd0, -2px 41.3333333333px #d5ff00, 36px -116.6666666667px #ff0062, 200px 79.3333333333px #aeff00, -108px 72.3333333333px #1900ff, -179px 42.3333333333px #ff001e, -102px -346.6666666667px #00ffae, -53px -306.6666666667px #c400ff, -193px -81.6666666667px #fbff00, 174px -140.6666666667px #ff002f, -211px -87.6666666667px #ff9500, -104px 73.3333333333px #f0f, -196px -198.6666666667px #0019ff, -4px 72.3333333333px #8cff00, 238px -274.6666666667px #0f2, -27px -21.6666666667px #00eaff;
        }
    }

    @-webkit-keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @-moz-keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @-o-keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @-ms-keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @keyframes gravity {
        to {
            transform: translateY(200px);
            -moz-transform: translateY(200px);
            -webkit-transform: translateY(200px);
            -o-transform: translateY(200px);
            -ms-transform: translateY(200px);
            opacity: 0;
        }
    }

    @-webkit-keyframes position {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-moz-keyframes position {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-o-keyframes position {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @-ms-keyframes position {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }

    @keyframes position {
        0%, 19.9% {
            margin-top: 10%;
            margin-left: 40%;
        }
        20%, 39.9% {
            margin-top: 40%;
            margin-left: 30%;
        }
        40%, 59.9% {
            margin-top: 20%;
            margin-left: 70%;
        }
        60%, 79.9% {
            margin-top: 30%;
            margin-left: 20%;
        }
        80%, 99.9% {
            margin-top: 30%;
            margin-left: 80%;
        }
    }


</style>


<div class="pyro">
    <div class="before"></div>
    <div class="after"></div>
</div>

<div class="ushop-gift">
    <h1 style="color: #fff; text-align: center;">Спасибо за регистрацию</h1>
</div>

<script>
    window.setTimeout(function () {
        window.location.replace("/");
    }, 2000);
</script>

</body>
</html>