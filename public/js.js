window.addEventListener("load", async () => {
    const subscribeButton = document.querySelector("#btn");

    // Register Service Worker
    const sW = await navigator.serviceWorker.register('/sw.js', {scope: '/'});
    console.log("Service Worker => ", sW);


        setTimeout(() => {
            document.querySelector('#notification-modal').style.display = 'block';
        }, 3000);

        // İzin ver butonuna tıklandığında
        document.querySelector('#allow-notifications-btn').addEventListener('click', function() {
            // Notification izni al
            Notification.requestPermission().then(permission => {
                if (permission === 'granted') {
                    // Kullanıcı izin verdiyse, abonelik işlemi yap
                    subscribeUserToPush();
                    // Modalı kapat
                    document.querySelector('#notification-modal').style.display = 'none';
                }
            });
        });

        // Reddet butonuna tıklandığında
        document.querySelector('#deny-notifications-btn').addEventListener('click', function() {
            // Modalı kapat
            document.querySelector('#notification-modal').style.display = 'none';
        });

    // subscribeButton.addEventListener("click", async () => {
    //     const serviceWorker = await navigator.serviceWorker.ready;
    //     const clientID = await serviceWorker.pushManager.subscribe({
    //         userVisibleOnly: true,
    //         applicationServerKey:
    //             "BJTPeX9fk1wsO_STFhP7vrDrRF6HLTXBH3QIEW2DSEguqKsaXsaIxC1cglTXxEWERtjnYtt1gtY54o9LiQ7fy5s",
    //         contentEncoding: "aes128gcm",
    //     });
    //
    //
    //     $.ajaxSetup({
    //         headers: {
    //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //         }
    //     });
    //
    //     $.ajax({
    //         url: '/subscribe',
    //         type: 'POST',
    //         data: clientID.toJSON(),
    //         success: function(data) {
    //             console.log("data :>> ", data);
    //             if (data.status === 201) {
    //                 alert("Success");
    //             }
    //         },
    //         error: function(error) {
    //             console.error(error);
    //         }
    //     });
    //
    // });
})


async function subscribeUserToPush() {
    const serviceWorker = await navigator.serviceWorker.ready;
    const clientID = await serviceWorker.pushManager.subscribe({
        userVisibleOnly: true,
        applicationServerKey:
            "BJTPeX9fk1wsO_STFhP7vrDrRF6HLTXBH3QIEW2DSEguqKsaXsaIxC1cglTXxEWERtjnYtt1gtY54o9LiQ7fy5s",
        contentEncoding: "aes128gcm",
    });


    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: '/subscribe',
        type: 'POST',
        data: clientID.toJSON(),
        success: function(data) {
            console.log("data :>> ", data);
            if (data.status === 201) {
                alert("Success");
            }
            else if (data.status === 500){
                alert("Kaydedilmiş");
            }
        },
        error: function(error) {
            console.error(error);
        }
    });
}




