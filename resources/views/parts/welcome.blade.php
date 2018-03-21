<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>The Hook at Mac</title>

        <!-- Icon -->
        <link rel="icon" href="img/SiteIcon.png">

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet">

        <!-- Styles -->
        <link rel="stylesheet" type="text/css" href="{{ asset('css/welcome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/640px/welcome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/responsiveDesign/640px/app.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('css/credits.css') }}">

        <!-- Scripts -->
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/welcome.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/credits.js') }}"></script>
        
    </head>
    <body>
        <div class="flexSection">
            <div class="welcomeColumn">
                <img class="verticalHook" src="img/VerticalHook.png">
                <img class="sectionPicture" src="img/VisitorsPhoto.jpg">
                <div id="visitorSection" class="sectionBox">
                    <div class="signUpBox">
                        <a href="/visitor-home"><button class="bigButton primaryButton horizontalCenter">
                            Visit Our Site
                        </button></a>
                        <p class="signUpDescription horizontalCenter">
                            Just want to check out what The Hook has inside? See everything we do for students and businesses without the obligation of signing up. If you like what you see you can always sign up later!
                        </p>
                    </div>
                </div>
            </div>
            <div class="welcomeColumn">
                <img class="verticalHook" src="img/VerticalHook.png">
                <img class="sectionPicture" src="img/StudentsPhoto.jpg">
                <div id="studentSection" class="sectionBox">
                    <div class="signUpBox">
                        <a href="/student-login"><button class="bigButton primaryButton horizontalCenter">
                            Student Login
                        </button></a>
                        <p class="signUpDescription horizontalCenter">
                            This is for each and every McMaster University student. Login to The Hook to get full access to events and activities loved by the community. Find out where and when your friends are going out and how you can make the best of your time at Mac U.
                        </p>
                    </div>
                </div>         
            </div>
            <div class="welcomeColumn">
                <img class="verticalHook" src="img/VerticalHook.png">
                <img class="sectionPicture" src="img/BusinessPhoto.jpg">
                <div id="businessSection" class="sectionBox">
                    <div class="signUpBox">
                        <a href="/business-login"><button class="bigButton primaryButton horizontalCenter">
                            Business Login
                        </button></a>
                        <p class="signUpDescription horizontalCenter">
                            Looking for a way to promote your company events and gain access to our student development teams? Login to The Hook as a business to get access to our marketing platform and project proposal process.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Work Credits -->
        <div id="credsContainer">
            <img class="credsImg" src="img/Creds.png" onclick="showCreds()">
            <div id="personalCreds" class="hideCreds">
                Photography: Cecilia Lee
                Designer: Ahren Mahler
                Developer: Ahren Mahler
                Planner: Ahren Mahler
            </div>
        </div>
    </body>
</html>