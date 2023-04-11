const CACHE_VERSION = 'v1';

self.addEventListener('install', function(event) {
    event.waitUntil(
        caches.open(CACHE_VERSION).then(function(cache) {
            return cache.addAll([
                '/', // Ana sayfa
            ]);
        })
    );
});

self.addEventListener('fetch', function(event) {
    event.respondWith(
        caches.match(event.request).then(function(response) {
            if (response) {
                return response;
            }

            return fetch(event.request).then(function(response) {
                if (!response || response.status !== 200 || response.type !== 'basic') {
                    return response;
                }

                const responseToCache = response.clone();

                caches.open(CACHE_VERSION).then(function(cache) {
                    cache.put(event.request, responseToCache);
                });

                return response;
            });
        })
    );
});

self.addEventListener('push', function(event) {
    let data = event.data.json();
    console.log("data :>> ", data);
    const payload = event.data ? data.body : 'no payload';

    event.waitUntil(
        self.registration.showNotification(data.title || "Bildirim", {
            body: payload,
            icon: data.icon || 'https://www.isinizburda.com/images/logo.png',
        })
    );
});

self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(
        clients.matchAll({
            type: 'window'
        })
            .then(function(clientList) {
                for (var i = 0; i < clientList.length; i++) {
                    var client = clientList[i];
                    if (client.url == '/' && 'focus' in client) {
                        return client.focus();
                    }
                }
                if (clients.openWindow) {
                    return clients.openWindow('https://www.isinizburda.com');
                }
            })
    );
});
