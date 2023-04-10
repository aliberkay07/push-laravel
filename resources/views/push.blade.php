<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        /* Modal background */
        .modal-backdrop {
            opacity: 0.7;
            background-color: rgba(0, 0, 0, 0.5);
        }

        /* Modal content */
        #notificationModal .modal-content {
            background-color: #f8f9fa;
            border-radius: 20px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.5);
            transform: translateY(-100%);
            animation: slide-in 0.5s forwards;
        }

        /* Modal title */
        #notificationModal .modal-title {
            font-size: 30px;
            font-weight: bold;
            color: #ff5722;
            margin-bottom: 20px;
        }

        /* Modal body */
        #notificationModal .modal-body {
            font-size: 20px;
            color: #333333;
            margin-bottom: 20px;
        }

        /* Modal buttons */
        #notificationModal .modal-footer .btn {
            font-size: 20px;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 5px;
        }

        /* Allow button */
        #notificationModal .modal-footer .btn-primary {
            background-color: #28a745;
            border-color: #28a745;
            color: #fff;
        }

        /* Deny button */
        #notificationModal .modal-footer .btn-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        /* Animation */
        @keyframes slide-in {
            to {
                transform: translateY(0%);
            }
        }



    </style>
</head>
<body>


    <h1>Pusher Test</h1>
    <button id="btn">Click Me</button>



    <div id="notification-modal" class="modal">
        <div class="modal-content">
            <h4>Bildirimlere izin verin!</h4>
            <p>En son haberlerimizden haberdar olmak için bildirimlerimize izin verin.</p>
            <div class="modal-buttons">
                <button id="allow-notifications-btn" class="btn green accent-4">İzin Ver</button>
                <button id="deny-notifications-btn" class="btn red">Reddet</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('js.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</body>
</html>
